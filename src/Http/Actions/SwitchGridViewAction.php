<?php

namespace D4T\Admin\Demos\Http\Actions\Grid;

use Dcat\Admin\Actions\Action;

class SwitchGridViewAction extends Action
{
    public function render()
    {
        $request = request();

        $img = $request->fullUrlWithQuery(['_view_' => 'img']);
        $list = $request->fullUrlWithQuery(['_view_' => 'list']);

        return <<<HTML
<div class="btn-group" data-toggle="buttons" style="margin: 0 5px">
    <a href="$img" class="btn btn-white ">
        <i class="feather icon-image"></i>
    </a>
    <a href="$list" class="btn btn-white ">
        <i class="feather icon-grid"></i>
    </a>
</div>
HTML;
    }
}
