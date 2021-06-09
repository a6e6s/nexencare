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

// loading plugin style
$data['header'] = '';
header("Content-Type: text/html; charset=utf-8");

require ADMINROOT . '/views/inc/header.php';
$member = (object) $data['member'];
?>

<!-- page content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('member_msg'); ?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['page_title']; ?> <small>عرض بيانات مسجل </small></h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/members" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-xs-12 col-xs-12">
            <div class="form-group">
                <h3 class="prod_title">
                    <?php echo "$member->first_name $member->second_name $member->last_name $member->family_name"; ?>
                </h3>
            </div>
            <div class="col-xs-6">
                <img src="<?php echo URLROOT . "/media/files/thumbs/" . $member->image; ?>">
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label">الجنسية : </label>
                    <?php echo $member->nationality; ?>
                </div>
                <div class="form-group">
                    <label class="control-label">الجنس : </label>
                    <?php echo $member->gender; ?>
                </div>
                <div class="form-group">
                    <label class="control-label">تاريخ الميلاد : </label>
                    <?php echo date("D d/M/Y", $member->birthdate); ?>
                </div>
                <div class="form-group">
                    <label class="control-label">الحالة : </label>
                    <p><?php echo $member->status ? 'مقروءة' : 'غير مقروءة'; ?></p>
                </div>
                <div class="form-group">
                    <label class="control-label">اخر تحديث : </label>
                    <p><?php echo $member->updated_at ? date('d/ M/ Y', $member->updated_at) : 'لا'; ?></p>
                </div>
                <div class="form-group">
                    <label class="control-label">وقت الإنشاء : </label>
                    <p><?php echo $member->created_at ? date('d/ M/ Y', $member->created_at) : 'لا'; ?></p>
                </div>
            </div>
            <div class="form-group col-xs-12">
                <a class="btn btn-info" href="<?php echo ADMINURL . '/members/edit/' . $member->member_id; ?>">تعديل</a>
            </div>


        </div>
    </div>
</div>

<?php
// loading plugin
$data['footer'] = '';

require ADMINROOT . '/views/inc/footer.php';
