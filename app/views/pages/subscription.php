<?php require APPROOT . '/app/views/inc/header.php'; ?>
<div class="text-center py-5 mb-0 undermenu  bg-primary text-light h3 bg-battern">
    <h3 class="py-4 mt-4"><?php echo $data['pageTitle']; ?></h3>
</div>
<div class="bg-light">
    <div class="container text-right py-2">
        <?php flash('msg'); ?>
        <div class="row justify-content-md-center">
            <div class="col-lg-12 py-3">
                <?php if (@exist($data['settings']['notifications']->memberContent)) echo $data['settings']['notifications']->memberContent; ?>
            </div>
            <div class="col-lg-6 col-sm-12 py-5">
                <form action="<?php echo URLROOT . '/pages/subscription'; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="needs-validation">
                    <fieldset class="border p-2">
                        <legend class="w-auto h6">الأسم رباعي:</legend>
                        <div class="form-group">
                            <input type="text" class="form-control <?php if (!empty($data['first_name_error'])) echo 'is-invalid'; ?>" name="first_name" placeholder="الاسم الاول" value="<?php echo $data['first_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['first_name_error']; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?php if (!empty($data['second_name_error'])) echo 'is-invalid'; ?>" name="second_name" placeholder="اسم الاب" value="<?php echo $data['second_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['second_name_error']; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?php if (!empty($data['last_name_error'])) echo 'is-invalid'; ?>" name="last_name" placeholder="اسم الجد" value="<?php echo $data['last_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['last_name_error']; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?php if (!empty($data['family_name_error'])) echo 'is-invalid'; ?>" name="family_name" placeholder="اسم العائلة" value="<?php echo $data['family_name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['family_name_error']; ?></span>
                        </div>
                    </fieldset>
                    <div class="form-group mt-3">
                        <label class="control-label <?php if (!empty($data['gender_error'])) echo 'is-invalid'; ?>" for="gender">الجنس : </label>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label ml-4">
                                <input class="form-check-input" type="radio" name="gender" <?php if ($data['gender'] == "ذكر") echo 'checked'; ?> value="ذكر"> ذكر
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" <?php if ($data['gender'] == "انثي") echo 'checked'; ?> value="انثي"> انثي
                            </label>
                        </div>
                        <span class="invalid-feedback"><?php echo $data['gender_error']; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($data['image_error'])) ? 'is-invalid' : ''; ?>">
                        <label class="control-label" for="imageUpload">صورة شخصية : </label>
                        <div class="has-feedback input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary" onclick="$(this).parent().find('input[type=file]').click();">اختار الملف</span>
                                <input name="image" value="<?php echo ($data['image']); ?>" onchange="$(this).parent().parent().find('.form-control').html($(this).val().split(/[\\|/]/).pop());" style="display: none;" type="file">
                            </span>
                            <span class="form-control"><small><?php echo empty($data['image']) ? ' قم بأختيار صورة مناسبةاو ملف PDF' : $data['image']; ?></small></span>
                        </div>
                        <div class="text-danger"><?php echo $data['image_error']; ?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="pageTitle">الجنسية : </label>
                        <select class="form-control <?php if (!empty($data['nationality_error'])) echo 'is-invalid'; ?>" name="nationality">
                            <option value="">اختار الجنسية </option>
                            <?php
                            foreach (nationality() as $nationality) {
                                echo "<option value=' $nationality'> $nationality</option>";
                            }
                            ?>
                            <span class="invalid-feedback"><?php echo $data['nationality_error']; ?></span>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="pageTitle">تاريخ الميلاد : </label>
                        <input type="date" class="form-control <?php if (!empty($data['birthdate_error'])) echo 'is-invalid'; ?>" name="birthdate" placeholder="تاريخ الميلاد" value="<?php echo $data['birthdate']; ?>">
                        <span class="invalid-feedback"><?php echo $data['birthdate_error']; ?></span>
                    </div>

                    <div class="form-group d-flex">
                        <img src="<?php echo URLROOT; ?>/pages/captcha" alt="captcha" width="100px">
                        <input type="text" class="form-control mr-2 <?php if (!empty($data['captcha_error'])) echo 'is-invalid'; ?>" name="captcha" placeholder=" كود التحقق">
                        <span class="invalid-feedback p-2"><?php echo $data['captcha_error']; ?></span>
                    </div>
                    <div class="col-xs-12 text-center">
                        <button type="submit" name="submit" class="btn btn-primary px-5 py-2"> ارسال الطلب
                            <i class="fa fa-save"> </i></button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/app/views/inc/footer.php'; ?>