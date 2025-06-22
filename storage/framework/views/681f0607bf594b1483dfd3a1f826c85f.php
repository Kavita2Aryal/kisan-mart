<?php 
$string_split = explode(" ", Auth::user()->name);
$inititals = $string_split[0][0] . (isset($string_split[1][0]) ? $string_split[1][0] : (isset($string_split[0][1]) ? $string_split[0][1] : ''));
?>
<div class="header">
    <div class="inline">
        <div class="visible-x">
            <a href="<?php echo e(route('dash.index')); ?>" class="p-l-15">
                <img src="<?php echo e(asset('assets/img/tccms-logo.svg')); ?>" alt="logo" style="width: 47%;">
            </a>
        </div>
        <div class="hidden-x">
            <a href="<?php echo e(route('dash.index')); ?>">
                <img src="<?php echo e(asset('assets/img/tccms-logo.svg')); ?>" alt="logo" style="width: 47%;">
            </a>
        </div>
    </div>
    <div class="inline">
        <div class="dropdown profile-menu">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown">
                <span class="thumbnail-wrapper d32 circular inline" style="background-color: #007a9f;">
                    <span class="text-white"><?php echo e(strtoupper($inititals)); ?></span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                <span class="dropdown-item fs-12 hint-text">
                    Signed in as <br />
                    <strong><?php echo e(\Str::limit(auth()->user()->name, 30)); ?>,</strong> <br />
                    <strong><?php echo e(\Str::limit(auth()->user()->email, 30)); ?></strong>
                </span>
                <?php if(session()->has('login-datetime')): ?>
                <div class="dropdown-divider"></div>
                <span class="dropdown-item fs-12 hint-text">
                    Signed in at:<br />
                    <span><?php echo e(\Carbon\Carbon::parse(session()->get('login-datetime'))->format('Y F j')); ?></span><br />
                    <span><?php echo e(\Carbon\Carbon::parse(session()->get('login-datetime'))->format('l, h:i A')); ?></span><br />
                    <span><?php echo e(\Carbon\Carbon::parse(session()->get('login-datetime'))->diffForHumans()); ?></span>
                </span>
                <?php endif; ?>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">My Profile</a>
                <a href="<?php echo e(route('log.me')); ?>" class="dropdown-item">My Activity</a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="event.preventDefault(); locking();">Lock Screen</a>
                <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(config('app.config.system.website')); ?>" target="_blank" class="dropdown-item fs-12 hint-text"><?php echo e(strtoupper(config('app.config.system.version'))); ?></a>
            </div>
        </div>
    </div>
</div><?php /**PATH /var/www/kisan-mart/resources/views/includes/header.blade.php ENDPATH**/ ?>