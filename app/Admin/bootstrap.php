<?php

// Copied from https://github.com/jqhph/dcat-admin-demo/blob/2.0/app/Admin/

use App\Admin\Actions\AdminSetting;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Navbar;
use Dcat\Admin\Support\Helper;

/**
 * Dcat-admin - admin builder based on Laravel.
 *
 * @author jqhph <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 */

// 覆盖默认配置
// config(['admin' => user_admin_config()]);
config(['app.locale' => config('admin.lang') ?: config('app.locale')]);

Admin::style('.main-sidebar .nav-sidebar .nav-item>.nav-link {
    border-radius: .1rem;
}');

// 扩展Column
Grid\Column::extend('code', function ($v) {
    return "<code>$v</code>";
});

Grid::resolving(function (Grid $grid) {
    if (!request('_row_')) {
        $grid->tableCollapse();
    }
});

// 追加菜单
Admin::menu()->add(include __DIR__ . '/menu.php', 0);

Admin::navbar(function (Navbar $navbar) {
    // 切换主题
    $method = config('admin.layout.horizontal_menu') ? 'left' : 'right';

    $navbar->$method(
        <<<'HTML'
<ul class="nav navbar-nav">
    <li class="nav-item">
        &nbsp;
        <a style="cursor: pointer" onclick="window.open('https://github.com/jqhph/dcat-admin-demo')">
            <i class="feather icon-github" style="font-size: 1.5rem"></i> DEMO源码下载
        </a>
        &nbsp; &nbsp;
    </li>
</ul>
HTML

    );

    // ajax请求不执行
    if (!Helper::isAjaxRequest()) {
        $navbar->$method(AdminSetting::make()->render());
    }

    // 下拉菜单
    // $navbar->right(view('admin.navbar-2'));

    // 下拉面板
    // $navbar->right(view('admin.navbar-1'));
});
