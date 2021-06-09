<?php

class Pages extends Controller
{
    private $pagesModel;
    public $settings;

    public function __construct()
    {
        $this->pagesModel = $this->model('Page');
        $this->settings = $this->pagesModel->getSettings();
    }
    /**
     * home page
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'الرئيسية: ' . SITENAME,
            'settings' => $this->settings,
        ];
        //loading the view
        $this->view('pages/index', $data);
    }

    public function show($id = '')
    {
        empty($id) ? redirect('pages', true) : null;
        ($page = $this->pagesModel->getPageById($id)) ? null :  redirect('pages', true);
        $data = [
            'settings' => $this->settings,
            'menu' => $this->menu,
            'page' => $page,
        ];

        $data['settings']['seo']->meta_keywords = $data['page']->meta_keywords;
        $data['settings']['seo']->meta_description = $data['page']->meta_description;
        $data['settings']['site']->image = $data['page']->image;
        $data['settings']['site']->title = $data['pageTitle'] = $data['page']->title;
        //loading view
        $this->view('pages/show', $data);
    }



    /**
     * members subscription page
     *
     * @return view
     */
    public function subscription()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'pageTitle' => 'تسجيل جديد',
                'settings' => $this->settings,
                'first_name' => trim($_POST['first_name']),
                'second_name' => trim($_POST['second_name']),
                'last_name' => trim($_POST['last_name']),
                'family_name' => trim($_POST['family_name']),
                'birthdate' => trim($_POST['birthdate']),
                'nationality' => trim($_POST['nationality']),
                'gender' => @trim($_POST['gender']),
                'image' => '',
                'status' => '',
                'status_error' => '',
                'gender_error' => '',
                'nationality_error' => '',
                'birthdate_error' => '',
                'first_name_error' => '',
                'second_name_error' => '',
                'last_name_error' => '',
                'family_name_error' => '',
                'captcha_error' => '',
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
            } else {
                $data['image_error'] = 'يجب ارفاق صورة شخصية';
            }
            //validate captcha
            if ($_SESSION['captcha'] != $_POST['captcha']) {
                $data['captcha_error'] = 'خطأ بكود التحقق ';
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
                if ($this->pagesModel->addMember($data)) {
                    if (!empty($data['settings']['notifications']->MemberEmail)) { //send notification
                        $msg = arrayLines($_POST);
                        $this->pagesModel->Email($data['settings']['notifications']->MemberEmail, ': اشعار حول طلب تسجيل متطوع جديد ', $msg);
                    }
                    flash('msg', 'تم استلام طلبك بنجاح وجاري مراجعته');
                    redirect('pages/subscription', true);
                } else {
                    flash('msg', 'هناك خطأ ما حاول مرة اخري', 'alert alert-danger');
                }
            }
        } else {
            $data = [
                'pageTitle' => 'تسجيل جديد',
                'settings' => $this->settings,
                'nationality' => '',
                'gender' => '',
                'first_name' => '',
                'last_name' => '',
                'second_name' => '',
                'family_name' => '',
                'birthdate' => '',
                'image' => '',
                'status' => 0,
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
        }
        $data['settings']['site']->title = $data['pageTitle'];
        //loading view
        $this->view('pages/subscription', $data);
    }

    /**
     * generate captcha code and store it in session for comparison 
     */
    public function captcha()
    {
        $code = rand('10000', '99999');
        $_SESSION['captcha'] = $code;
        $image = imagecreate(200, 70);
        $bg = imagecolorallocatealpha($image, 100, 100, 100, 0);
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        $gray = imagecolorallocatealpha($image, 150, 150, 150, 0);
        imagettftext($image, 66, 0, 10, 70, $gray, APPROOT . '/public/templates/nexencare/css/fonts/ae_AlHor.ttf', '@#0% +');
        imagettftext($image, 66, 0, 10, 70, $gray, APPROOT . '/public/templates/nexencare/css/fonts/ae_AlHor.ttf', '+#@ 0%');
        imagettftext($image, 36, 0, 30, 50, $white, APPROOT . '/public/templates/nexencare/css/fonts/ae_AlHor.ttf', $code);
        header('Content-Type: image/png');
        imagepng($image);
    }
}
