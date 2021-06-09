<?php
/*
 * Copyright (C) 2018 Easy CMS Framework Ahmed Elmahdy
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License
 * @license    https://opensource.org/licenses/GPL-3.0
 *
 * @package    Easy CMS MVC framework
 * @author     Ahmed Elmahdy
 * @link       https://ahmedx.com
 *
 * For more information about the author , see <http://www.ahmedx.com/>.
 */

class Members extends ControllerAdmin
{
    private $memberModel;
    public function __construct()
    {
        $this->memberModel = $this->model('Member');
    }
    /**
     * loading index view with latest members
     */
    public function index($current = '', $perpage = 50)
    {
        // get members
        $cond = 'WHERE status <> 2 ';
        $bind = [];
        //check user action if the form has submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //handling Delete
            if (isset($_POST['delete'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->memberModel->deleteById($_POST['record'], 'member_id')) {
                        flash('member_msg', 'تم حذف ' . $row_num . ' بنجاح');
                    } else {
                        flash('member_msg', 'لم يتم الحذف', 'alert alert-danger');
                    }
                }
                redirect('members');
            }
            //handling Publish
            if (isset($_POST['publish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->memberModel->publishById($_POST['record'], 'member_id')) {
                        flash('member_msg', 'تم نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('member_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('members');
            }
            //handling Unpublish
            if (isset($_POST['unpublish'])) {
                if (isset($_POST['record'])) {
                    if ($row_num = $this->memberModel->unpublishById($_POST['record'], 'member_id')) {
                        flash('member_msg', 'تم ايقاف نشر ' . $row_num . ' بنجاح');
                    } else {
                        flash('member_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
                    }
                }
                redirect('members');
            }
        }
        //handling search
        $searches = $this->memberModel->searchHandling(['first_name', 'second_name', 'last_name', 'family_name', 'nationality', 'gender', 'status'], $current);
        $cond .= $searches['cond'];
        $bind = $searches['bind'];

        if(@exist($_POST['search']['from'])){
            $cond .= " AND birthdate >= ".strtotime($_POST['search']['from']);
        }
        if(@exist($_POST['search']['to'])){
            $cond .= " AND birthdate <= ".strtotime($_POST['search']['to']);
        }
        // get all records count after search and filtration
        $recordsCount = $this->memberModel->allMembersCount($cond, $bind);
        // make sure its integer value and its usable
        $current = (int) $current;
        $perpage = (int) $perpage;
        ($perpage == 0) ? $perpage = 20 : null;
        if ($current <= 0 || $current > ceil($recordsCount->count / $perpage)) {
            $current = 1;
            $limit = 'LIMIT 0 , :perpage ';
            $bindLimit[':perpage'] = $perpage;
        } else {
            $limit = 'LIMIT  ' . (($current - 1) * $perpage) . ', :perpage';
            $bindLimit[':perpage'] = $perpage;
        }
        //get all records for current member
        $members = $this->memberModel->getMembers($cond, $bind, $limit, $bindLimit);
        $data = [
            'current' => $current,
            'perpage' => $perpage,
            'header' => '',
            'title' => 'المسجلون',
            'members' => $members,
            'recordsCount' => $recordsCount->count,
            'footer' => '',
        ];
        $this->view('members/index', $data);
    }

    /**
     * update member
     * @param integer $id
     */
    public function edit($id)
    {
        $id = (int) $id;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'page_title' => 'المسجلون',
                'member_id' => $id,
                'first_name' => trim($_POST['first_name']),
                'second_name' => trim($_POST['second_name']),
                'last_name' => trim($_POST['last_name']),
                'family_name' => trim($_POST['family_name']),
                'birthdate' => trim($_POST['birthdate']),
                'nationality' => trim($_POST['nationality']),
                'gender' => @trim($_POST['gender']),
                'image' => '',
                'status' => trim($_POST['status']),
                'status_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'birthdate_error' => '',
                'first_name_error' => '',
                'second_name_error' => '',
                'last_name_error' => '',
                'family_name_error' => '',
                'image_error' => '',
            ];
            // validate first_name
            !(empty($data['first_name'])) ?: $data['first_name_error'] = 'هذا الحقل مطلوب';
            // validate second_name
            !(empty($data['second_name'])) ?: $data['second_name_error'] = 'هذا الحقل مطلوب';
            // validate last_name
            !(empty($data['last_name'])) ?: $data['last_name_error'] = 'هذا الحقل مطلوب';
            // validate family_name
            !(empty($data['family_name'])) ?: $data['family_name_error'] = 'هذا الحقل مطلوب';
            // validate gender
            !(empty($data['gender'])) ?: $data['gender_error'] = 'هذا الحقل مطلوب';
            // validate birthdate
            !(empty($data['birthdate'])) ?: $data['birthdate_error'] = 'هذا الحقل مطلوب';
            // validate nationality
            !(empty($data['nationality'])) ?: $data['nationality_error'] = 'هذا الحقل مطلوب';
            // validate image
            if ($_FILES['image']['error'] == 0) {
                $image = uploadImage('image', APPROOT . '/media/files/subscription/', 5000000, false);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            } 
            //make sure there is no errors
            if (
                empty($data['first_name_error'])
                && empty($data['second_name_error'])
                && empty($data['last_name_error'])
                && empty($data['family_name_error'])
                && empty($data['image_error'])
                && empty($data['gender_error'])
                && empty($data['birthdate_error'])
                && empty($data['captcha_error'])
            ) {
                //validated
                if ($this->memberModel->updateMember($data)) {
                    flash('member_msg', 'تم التعديل بنجاح');
                    isset($_POST['save']) ? redirect('members/edit/' . $id) : redirect('members');
                } else {
                    flash('member_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('members/edit', $data);
            }
        } else {
            // featch member
            if (!$member = $this->memberModel->getMemberById($id)) {
                flash('member_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
                redirect('members');
            }
            $data = [
                'page_title' => 'المسجلون',
                'member_id' => $id,
                'first_name' => $member->first_name,
                'last_name' => $member->last_name,
                'second_name' => $member->second_name,
                'family_name' => $member->family_name,
                'nationality' => $member->nationality,
                'gender' => $member->gender,
                'birthdate' => date('Y-m-d',$member->birthdate),
                'image' => $member->image,
                'status' => $member->status,
                'status_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'birthdate_error' => '',
                'first_name_error' => '',
                'last_name_error' => '',
                'second_name_error' => '',
                'family_name_error' => '',
                'captcha_error' => '',
                'image_error' => '',
            ];
            $this->view('members/edit', $data);
        }
    }

    /**
     * showing member details
     * @param integer $id
     */
    public function show($id)
    {
        if (!$member = $this->memberModel->getMemberById($id)) {
            flash('member_msg', 'هناك خطأ ما هذه الصفحة غير موجوده او ربما اتبعت رابط خاطيء ', 'alert alert-danger');
            redirect('members');
        }
        $this->memberModel->publishById([$id], 'member_id');
        $data = [
            'page_title' => 'المسجلون',
            'member' => $member,
        ];
        $this->view('members/show', $data);
    }

    /**
     * delete record by id
     * @param integer $id
     */
    public function delete($id)
    {
        if ($row_num = $this->memberModel->deleteById([$id], 'member_id')) {
            flash('member_msg', 'تم حذف ' . $row_num . ' بنجاح');
        } else {
            flash('member_msg', 'لم يتم الحذف', 'alert alert-danger');
        }
        redirect('members');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function publish($id)
    {
        if ($row_num = $this->memberModel->publishById([$id], 'member_id')) {
            flash('member_msg', 'تم تعليم كا مقروءة ' . $row_num . ' بنجاح');
        } else {
            flash('member_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('members');
    }

    /**
     * publish record by id
     * @param integer $id
     */
    public function unpublish($id)
    {
        if ($row_num = $this->memberModel->unpublishById([$id], 'member_id')) {
            flash('member_msg', 'تم تعليم كا غير مقروءة ' . $row_num . ' بنجاح');
        } else {
            flash('member_msg', 'هناك خطأ ما يرجي المحاولة لاحقا', 'alert alert-danger');
        }
        redirect('members');
    }
}
