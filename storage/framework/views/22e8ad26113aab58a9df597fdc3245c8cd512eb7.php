<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Gambling.com File Upload</title>
</head>
<body>
    <div class="container mt-5">
        <form action="<?php echo e(route('fileUpload')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload File
            </button>
        </form>


        <?php if(isset( $allrecords )): ?>
            <div style="margin-top: 50px;">
                <h1>Affiliates Within 100km </h1>
                <table class="table">
                    <tr>
                        <th>Affiliate ID</th>
                        <th>Name</th>
                    </tr>

                    <?php $__currentLoopData = $allrecords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($record->affiliate_id); ?>

                            </td>
                            <td>
                                <?php echo e($record->name); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/file_upload.blade.php ENDPATH**/ ?>