<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
    </head>
    <body>        
        <div id="app">
        </div>
        <script src="<?php echo e(mix('js/app.js')); ?>" type="text/javascript"></script>
    </body>
</html>
<?php /**PATH D:\projects\laravel-vue-curd\resources\views/app.blade.php ENDPATH**/ ?>