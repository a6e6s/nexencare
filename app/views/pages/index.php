<?php
require APPROOT . '/app/views/inc/header.php';
flash('msg');
?>
<div class="container text-right">
    <div class="row my-5">
        <img src="<?php echo MEDIAURL ?>/imacIMG.png" alt="منصة ذكية" class="col-4">
        <div class="col-8">
            <h1 class="text-primary">منصة ذكية</h1>
            <h3 class="text-secondary h5">الإجراءات والمعايير الصحية</h3>
            <p class="py-3">
                نظام نكسن هو نظام إلكتروني تفاعلي لإدارة الخدمات وميكنة الإجراءات الصحية بحيث يحتوي النظام على ملف صحي موحد مع وحدات طبية وإدراية مختلفة تخدم كافة الأقسام المختلفة داخل المنشأة الصحية، ويقوم النظام بالربط بين مختلف المنشآت والأنظمة الصحية ويساهم في تحقيق التحول الرقمي بتطبيق أفضل المعايير الصحية مع ميزة تقديم هذه المنصة على الشبكة السحابية لضمان سرعة التنفيذ وسهولة الاستخدام مع تقليل الجهد والمخاطر والتكلفة.
            </p>
        </div>
    </div>
</div>
<?php if ($data['settings']['site']->show_video) : ?>
    <section id="video" class="bg-battern wow bounceInUp py-5">
        <div class="container">
            <div class="row text-center">
                <div class="video-content col-12 col-lg-4 border rounded bg-dark bg-battern my-2">
                    <h4 class="h4 text-white my-5"><?php echo $data['settings']['site']->videoTitle; ?> </h4>
                    <p class="text-light"><?php echo $data['settings']['site']->videoDescription; ?></p>
                    <a href="<?php echo $data['settings']['site']->videoMore; ?>" class="btn btn-outline-primary m-3">المزيد</a>
                </div>
                <div class="col-lg-8 col-12 video-file my-2">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item rounded" src="<?php echo str_replace('https://youtu.be/', 'https://www.youtube.com/embed?playlist=', $data['settings']['site']->videoURL); ?>&rel=0;&autoplay=1&mute=1&loop=1" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- video end -->
<?php endif; ?>
<?php require APPROOT . '/app/views/inc/footer.php'; ?>