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
?>

<!-- setting content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('setting_msg');?>
    <div class="setting-title">
        <div class="title_right">
            <h3><small>التعديل علي  </small><?php echo $data['title']; ?> </h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/settings" class="btn btn-success pull-left">عودة <i class="fa fa-reply"></i></a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="<?php echo ADMINURL . '/settings/edit/' . $data['setting_id']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" >
                <div class="form-group">
                    <label class="control-label" for="settingTitle">عنوان الاعداد : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="title" placeholder="عنوان الاعداد" value="<?php echo $data['title']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">عنوان الموقع : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[title]" placeholder="عنوان الموقع" value="<?php echo $data['value']->title; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">عن الموقع : </label>
                    <div class="has-feedback">
                        <textarea type="text" id="settingTitle" class="form-control" name="value[about]" placeholder="عن الموقع" ><?php echo $data['value']->about; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="settingTitle">رسالة الترحيب : </label>
                    <div class="has-feedback">
                        <input type="text" id="settingTitle" class="form-control" name="value[welcomeText]" placeholder="رسالة الترحيب" value="<?php echo $data['value']->welcomeText; ?>">
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">كود الهيدر  : </label>
                    <div class="row">
                        <textarea name="value[header_code]" class="form-control"><?php echo ($data['value']->header_code); ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label class="control-label">كود الفوتر  : </label>
                    <div class="row">
                        <textarea name="value[footer_code]" class="form-control"><?php echo ($data['value']->footer_code); ?></textarea>
                    </div>
                </div>
                <div class="form-group col-xs-12 ">
                    <label class="control-label">حالة الفيديو :</label>
                    <div class="radio">
                        <label>
                            <input type="radio" class="flat" <?php echo ($data['value']->show_video == 1) ? 'checked' : ''; ?> value="1" name="value[show_video]"> اظهار الفيديو 
                        </label>
                        <label>
                            <input type="radio" class="flat" <?php echo ($data['value']->show_video == '0') ? 'checked' : ''; ?> value="0" name="value[show_video]"> اخفاء الفيديو
                        </label>
                    </div>
                    <label class="control-label" for="category_text">عنوان الفيديو : </label>
                    <div class="has-feedback">
                        <input type="text" id="category_text" class="form-control" name="value[videoTitle]" placeholder="عنوان الفيديو" value="<?php echo $data['value']->videoTitle; ?>">
                    </div>
                    <label class="control-label" for="category_text">وصف الفيديو : </label>
                    <div class="has-feedback">
                        <input type="text" id="category_text" class="form-control" name="value[videoDescription]" placeholder="وصف الفيديو" value="<?php echo $data['value']->videoDescription; ?>">
                    </div>
                    <label class="control-label" for="category_text">رابط الفيديو : </label>
                    <div class="has-feedback">
                        <input type="text" id="category_text" class="form-control" name="value[videoURL]" placeholder="رابط الفيديو" value="<?php echo $data['value']->videoURL; ?>">
                    </div>
                    <label class="control-label" for="category_text">رابط المزيد : </label>
                    <div class="has-feedback">
                        <input type="text" id="category_text" class="form-control" name="value[videoMore]" placeholder="رابط المزيد" value="<?php echo $data['value']->videoMore; ?>">
                    </div>
                </div>
                <div class="form-group col-xs-12 ">
                    <label class="control-label">حالة الفوتر :</label>
                    <div class="radio">
                        <label>
                            <input type="radio" class="flat" <?php echo ($data['value']->show_footer == 1) ? 'checked' : ''; ?> value="1" name="value[show_footer]"> اظهار الفوتر 
                        </label>
                        <label>
                            <input type="radio" class="flat" <?php echo ($data['value']->show_footer == '0') ? 'checked' : ''; ?> value="0" name="value[show_footer]"> اخفاء الفوتر
                        </label>
                    </div>
                </div>
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <button type="submit" name="save" class="btn btn-success">تعديل
                        <i class="fa fa-save"> </i></button>
                    <button type="submit" name="submit" class="btn btn-success">تعديل وعودة
                        <i class="fa fa-save"> </i></button>
                    <button type="reset" class="btn btn-danger">مسح
                        <i class="fa fa-trash "> </i></button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php
// loading plugin

$data['footer'] = '<script src="' . ADMINURL . '/template/default/vendors/ckeditor/ckeditor.js"></script>
                   <script src="' . ADMINURL . '/template/default/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
                <script>
                //filemanagesr for ck editor
                    CKEDITOR.replace("ckeditor", {
                        filebrowserBrowseUrl: "' . ADMINURL . '/helpers/filemanager/dialog.php?type=2&editor=ckeditor&fldr=" ,
                        filebrowserUploadUrl: "' . ADMINURL . '/helpers/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
                        filebrowserImageBrowseUrl: "' . ADMINURL . '/helpers/filemanager/dialog.php?type=1&editor=ckeditor&fldr="
                    });
                </script>'."\n";
require ADMINROOT . '/views/inc/footer.php';
