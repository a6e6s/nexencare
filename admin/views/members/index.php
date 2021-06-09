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

// loading  plugin style
$data['header'] = '';

require ADMINROOT . '/views/inc/header.php';
?>

<!-- page content -->

<div class="right_col" role="main">
    <div class="clearfix"></div>
    <?php flash('member_msg'); ?>
    <div class="page-title">
        <div class="title_right">
            <h3><?php echo $data['title']; ?> <small>عرض كافة <?php echo $data['title']; ?> </small></h3>
        </div>
        <div class="title_left">
            <a href="<?php echo ADMINURL; ?>/settings/edit/10#member" class="btn btn-primary pull-left">الاعدادات <i class="fa fa-plus"></i></a>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <form action="" method="post">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class=" form-group-sm">
                                <th></th>
                                <th width="50px"><input type="submit" name="search[submit]" value="بحث" class="btn btn-sm btn-primary search-query" /></th>
                                <th class=""><input type="search" class="form-control" placeholder="بحث الاسم الاول" name="search[first_name]" value=""></th>
                                <th class=""><input type="search" class="form-control" placeholder="بحث الاسم الاب" name="search[second_name]" value=""></th>
                                <th class=""><input type="search" class="form-control" placeholder="بحث اسم الجد" name="search[last_name]" value=""></th>
                                <th><input type="search" class="form-control" placeholder="بحث الاسم العائلة" name="search[family_name]" value=""></th>
                                <th class=""><input type="search" class="form-control" placeholder="بحث بالجنس" name="search[gender]" value=""></th>
                                <th class=""><input type="search" class="form-control" placeholder="بحث بالجنسية" name="search[nationality]" value=""></th>
                                <th class="form-inline" colspan="3">
                                    من<input type="date" class="form-control" name="search[from]" value="">
                                   الي <input type="date" class="form-control" name="search[to]" value="">
                                </th>
                                <th width="150px">
                                    <select class="form-control" name="search[status]">
                                        <option value=""></option>
                                        <option value="1">مقروء </option>
                                        <option value="0"> غير مقروء </option>
                                    </select>
                                </th>
                            </tr>
                            <tr class="headings">
                                <th>
                                    <input type="checkbox" id="check-all" class="flat">
                                </th>
                                <th class="column-title">صورة </th>
                                <th class="column-title">الاسم الاول </th>
                                <th class="column-title">اسم الاب </th>
                                <th class="column-title">اسم الجد </th>
                                <th class="column-title">اسم العائلة </th>
                                <th class="column-title"> الجنس </th>
                                <th class="column-title"> الجنسية </th>
                                <th class="column-title"> تاريخ الميلاد </th>
                                <th class="column-title">تاريخ الانشاء </th>
                                <th class="column-title">آخر تحديث </th>
                                <th class="column-title no-link last"><span class="nobr">اجراءات</span>
                                </th>
                                <th class="bulk-actions" colspan="12">
                                    <span> تنفيذ علي الكل :</span>
                                    <input type="submit" name="publish" value="مقروءة" class="btn btn-success btn-xs" />
                                    <input type="submit" name="unpublish" value="غير مقروءة" class="btn btn-warning btn-xs" />
                                    <input type="submit" name="delete" value="حذف" onclick="return confirm('Are you sure?') ? true : false" class="btn btn-danger btn-xs" />
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ((object) $data['members'] as $member) : ?>
                                <tr class="even pointer <?php echo $member->status ? '' : ' selected '; ?>">
                                    <td class="a-center">
                                        <input type="checkbox" class="records flat" name="record[]" value="<?php echo $member->member_id; ?>">
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo URLROOT . "/media/files/members/" . $member->image; ?>" target="blank">
                                            <img src="<?php echo URLROOT . "/media/files/thumbs/" . $member->image; ?>" height="30px">
                                        </a>
                                    </td>
                                    <td class=""><?php echo $member->first_name; ?></td>
                                    <td class=""><?php echo $member->second_name; ?></td>
                                    <td class=""><?php echo $member->last_name; ?></td>
                                    <td class=""><?php echo $member->family_name; ?></td>
                                    <td class=""><?php echo $member->gender; ?></td>
                                    <td class=""><?php echo $member->nationality; ?></td>
                                    <td class="ltr"><?php echo date('Y/ m/ d ', $member->birthdate); ?></td>
                                    <td class="ltr"><?php echo date('Y/ m/ d | H:i a', $member->created_at); ?></td>
                                    <td class="ltr"><?php echo date('Y/ m/ d | H:i a', $member->updated_at); ?></td>
                                    <td class="form-group">
                                        <?php
                                        if (!$member->status) {
                                            echo '<a href="' . ADMINURL . '/members/publish/' . $member->member_id . '" class="btn btn-xs btn-warning" type="button" data-toggle="tooltip" data-original-title="غير مقروء"><i class="fa  fa-envelope-o"></i></a>';
                                        } elseif ($member->status == 1) {
                                            echo '<a href="' . ADMINURL . '/members/unpublish/' . $member->member_id . '" class="btn btn-xs btn-success" type="button" data-toggle="tooltip" data-original-title="مقروء"><i class="fa fa-envelope"></i></a>';
                                        }
                                        ?>
                                        <a href="<?php echo ADMINURL . '/members/show/' . $member->member_id; ?>" class="btn btn-xs btn-success" data-placement="top" data-toggle="tooltip" data-original-title="عرض"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo ADMINURL . '/members/edit/' . $member->member_id; ?>" class="btn btn-xs btn-primary" data-placement="top" data-toggle="tooltip" data-original-title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo ADMINURL . '/members/delete/' . $member->member_id; ?>" class="btn btn-xs btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="حذف" onclick="return confirm('Are you sure?') ? true : false"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <tr class="tab-selected">
                                <th></th>
                                <th class="column-title" colspan="2"> العدد الكلي : <?php echo $data['recordsCount']; ?> </th>
                                <th class="column-title" colspan="5"> </th>
                                <th class="column-title"> عرض
                                    <select name="perpage" onchange="if (this.value)
                                                window.location.href = '<?php echo ADMINURL . '/members/index/' . $data['current']; ?>' + '/' + this.value">
                                        <option value="10" <?php echo ($data['perpage'] == 10) ? 'selected' : null; ?>>10 </option>
                                        <option value="50" <?php echo ($data['perpage'] == 50) ? 'selected' : null; ?>>50 </option>
                                        <option value="100" <?php echo ($data['perpage'] == 100) ? 'selected' : null; ?>>100 </option>
                                        <option value="200" <?php echo ($data['perpage'] == 200) ? 'selected' : null; ?>>200 </option>
                                        <option value="500" <?php echo ($data['perpage'] == 500) ? 'selected' : null; ?>>500 </option>
                                        <option value="1000" <?php echo ($data['perpage'] == 1000) ? 'selected' : null; ?>>1000 </option>
                                    </select>
                                </th>
                                <th class="column-title no-link last" colspan="5"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <ul class="pagination text-center">
                    <?php
                    pagination($data['recordsCount'], $data['current'], $data['perpage'], 4, ADMINURL . '/members');
                    ?>
                </ul>


            </form>

        </div>
    </div>
</div>
<?php
// loading  plugin
$data['footer'] = '';

require ADMINROOT . '/views/inc/footer.php';
