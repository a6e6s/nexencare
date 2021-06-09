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
     * adding new member
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'page_title' => 'المسجلون',
                'identity' => trim($_POST['identity']),
                'image' => '',
                'full_name' => trim($_POST['full_name']),
                'phone' => trim($_POST['phone']),
                'nationality' => trim($_POST['nationality']),
                'gender' => trim($_POST['gender']),
                'email' => trim($_POST['email']),
                'status' => '',
                'status_error' => '',
                'email_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'identity_error' => '',
                'phone_error' => '',
                'full_name_error' => '',
                'image_error' => '',
            ];
            // validate identity
            !(empty($data['identity'])) ?: $data['identity_error'] = 'هذا الحقل مطلوب';
            // validate gender
            !(empty($data['gender'])) ?: $data['gender_error'] = 'هذا الحقل مطلوب';
            // validate email
            !(empty($data['email'])) ?: $data['email_error'] = 'هذا الحقل مطلوب';
            // validate phone
            !(empty($data['phone'])) ?: $data['phone_error'] = 'هذا الحقل مطلوب';
            // validate nationality
            !(empty($data['nationality'])) ?: $data['nationality_error'] = 'هذا الحقل مطلوب';
            // validate full_name
            !(empty($data['full_name'])) ?: $data['full_name_error'] = 'هذا الحقل مطلوب';
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            // validate image
            if ($_FILES['image']['error'] != 4) {
                $image = uploadImage('image', ADMINROOT . '/../media/files/members/', 5000000, false);
                if (empty($image['error'])) {
                    $data['image'] = $image['filename'];
                } else {
                    if (!isset($image['error']['nofile'])) {
                        $data['image_error'] = implode(',', $image['error']);
                    }
                }
            } else {
                $data['image_error'] = "من فضلك قم برفع ملف الهوية";
            }
            //make sure there is no errors
            if (
                empty($data['status_error']) && empty($data['full_name_error']) && empty($data['gender_error']) && empty($data['email_error'])
                && empty($data['phone_error']) && empty($data['image_error'])
            ) {
                //validated
                if ($this->memberModel->addMember($data)) {
                    flash('member_msg', 'تم الحفظ بنجاح');
                    redirect('members');
                } else {
                    flash('member_msg', 'هناك خطأ مه حاول مرة اخري', 'alert alert-danger');
                }
            } else {
                //load the view with error
                $this->view('members/add', $data);
            }
        } else {
            $data = [
                'page_title' => 'المسجلون',
                'identity' => '',
                'image' => '',
                'nationality' => '',
                'gender' => '',
                'email' => '',
                'district' => '',
                'message' => '',
                'full_name' => '',
                'phone' => '',
                'city' => '',
                'status' => 0,
                'status_error' => '',
                'email_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'phone_error' => '',
                'identity_error' => '',
                'full_name_error' => '',
                'image_error' => '',
            ];
        }
        //loading the add member view
        $this->view('members/add', $data);
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
                'identity' => trim($_POST['identity']),
                'image' => '',
                'full_name' => trim($_POST['full_name']),
                'phone' => trim($_POST['phone']),
                'nationality' => trim($_POST['nationality']),
                'gender' => trim($_POST['gender']),
                'email' => trim($_POST['email']),
                'status' => '',
                'status_error' => '',
                'email_error' => '',
                'identity_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'phone_error' => '',
                'full_name_error' => '',
                'image_error' => '',
            ];
            // validate gender
            !(empty($data['gender'])) ?: $data['gender_error'] = 'هذا الحقل مطلوب';
            // validate email
            !(empty($data['email'])) ?: $data['email_error'] = 'هذا الحقل مطلوب';
            // validate phone
            !(empty($data['phone'])) ?: $data['phone_error'] = 'هذا الحقل مطلوب';
            // validate nationality
            !(empty($data['nationality'])) ?: $data['nationality_error'] = 'هذا الحقل مطلوب';
            // validate full_name
            !(empty($data['full_name'])) ?: $data['full_name_error'] = 'هذا الحقل مطلوب';
            // validate status
            if (isset($_POST['status'])) {
                $data['status'] = trim($_POST['status']);
            }
            if ($data['status'] == '') {
                $data['status_error'] = 'من فضلك اختار حالة النشر';
            }
            // validate image
            if ($_FILES['image']['error'] != 4) {
                $image = uploadImage('image', ADMINROOT . '/../media/files/members/', 5000000, false);
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
                empty($data['status_error']) && empty($data['full_name_error'])
                && empty($data['gender_error']) && empty($data['email_error']) && empty($data['phone_error']) && empty($data['image_error'])
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
                'full_name' => $member->full_name,
                'identity' => $member->identity,
                'image' => $member->image,
                'phone' => $member->phone,
                'nationality' => $member->nationality,
                'gender' => $member->gender,
                'email' => $member->email,
                'status' => $member->status,
                'status_error' => '',
                'email_error' => '',
                'identity_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'phone_error' => '',

                'full_name_error' => '',
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
