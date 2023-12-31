<?php

namespace D4T\Admin\Demos\Http\Controllers\Dashboards;

use Faker\Factory;
use Dcat\Admin\DcatIcon;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Enums\RouteAuth;
use Dcat\Admin\Widgets\ImageAdv;
use Dcat\Admin\Widgets\StatItem;
use D4T\Core\Enums\StyleClassType;
use Dcat\Admin\Widgets\SimpleCard;
use Illuminate\Routing\Controller;
use Dcat\Admin\Widgets\StatProgress;
use Dcat\Admin\Widgets\IconWithToolTip;
use Dcat\Admin\Widgets\Cards\ProfitCard;
use Dcat\Admin\Widgets\Cards\PictureCard;
use Dcat\Admin\Widgets\Metrics\RadialBar;
use Dcat\Admin\Widgets\ApexCharts\RadialBarChart;

class AnalyticController extends Controller
{
    public function index(Content $content)
    {
        $faker = Factory::create();
        return $content
            ->header('Analytics Dashboard')
            ->description('Analytics Dashboard...')
            ->body(function (Row $row) use($faker) {
                $row->column(8, new PictureCard(
                    __('admin.title'),
                    __('admin.description'),
                    admin_route(RouteAuth::PROFILE()),
                    new ImageAdv('/vendor/dcat-admin/img/illustrations/man-with-laptop-light.png', '/vendor/dcat-admin/img/illustrations/man-with-laptop-dark.png', 'man-with-laptop-light'))
                );
                $row->column(2, (new ProfitCard('Profit', '$2000', '78%', DcatIcon::HOME, new IconWithToolTip(DcatIcon::HELP(), $faker->text(100)), admin_route(RouteAuth::PROFILE())))->growing());
                $row->column(2, (new ProfitCard('Sales', '-$2000', '-78%', DcatIcon::HOME, new IconWithToolTip(DcatIcon::HELP(), $faker->text(100)), admin_route(RouteAuth::PROFILE())))->growing(false));
            })
            ->body(function (Row $row) use($faker) {

                $item1 = (new StatItem(DcatIcon::HOME(true), 'Electronics', 'Mobile, Earbuds, TV', '24.2k'))->render();
                $item2 = (new StatItem(DcatIcon::HOME(true), 'Fish', 'test', '24.2k'))->inverse()->withCard()->render();
                $row->column(3, new Card('Orders', $item1.$item2));
            })
            ->body(function (Row $row) use($faker) {

                $progress1 = (new StatProgress(DcatIcon::HOME(true), 'Max Days', 2/5*100, '2/5', StyleClassType::INFO))->render();
                $progress2 = (new StatProgress(DcatIcon::HOME(true), 'Max Days', 3/5*100, '3/5', StyleClassType::WARNING))->render();
                $progress3 = (new StatProgress(DcatIcon::HOME(true), 'Max Days', 4/5*100, '4/5', StyleClassType::DANGER))->render();

                $row->column(8, new Card('Trading Objectives', $progress1.$progress2.$progress3));
            })
            ->body(function (Row $row) use($faker) {

                $progress1 = (new StatProgress(DcatIcon::HOME(true), 'Max Loss', 3450/5000*100, '$3450 / $5000', StyleClassType::DANGER))->render();
                $progress2 = (new StatProgress(DcatIcon::HOME(true), 'Max Loss', 2000/5000*100, '$3450 / $5000', StyleClassType::WARNING))->render();
                $progress3 = (new StatProgress(DcatIcon::HOME(true), 'Max Loss', 1000/5000*100, '$100 / $5000', StyleClassType::INFO))->render();

                $row->column(8, new Card('Trading Objectives', $progress1.$progress2.$progress3));
            })
            ->body(function (Row $row) use($faker) {

                $progress1 = (new StatProgress(DcatIcon::HOME(true), 'Profit Target', 3450/5000*100, '$3450 / $5000', StyleClassType::PRIMARY))->withCard()->render();
                $progress2 = (new StatProgress(DcatIcon::HOME(true), 'Profit Target', 2000/5000*100, '$3450 / $5000', StyleClassType::WARNING))->withCard()->render();
                $progress3 = (new StatProgress(DcatIcon::HOME(true), 'Profit Target', 1000/5000*100, '$100 / $5000', StyleClassType::DANGER))->withCard()->render();

                $row->column(8, (new SimpleCard('Trading Objectives', $progress1.$progress2.$progress3))->tool(new IconWithToolTip(DcatIcon::HELP(), 'test')));
            })
            ->body(function (Row $row) use($faker) {

                $radialBar = new RadialBarChart();
                $radialBar->value(89);
                $radialBar->hollowSize(30);
                //$radialBar->height(380);
                $row->column(3, (new SimpleCard('Profit Target', $radialBar))->tool(new IconWithToolTip(DcatIcon::HELP(), 'Profit Target'))
                    //->style('height: 380px;')
                    ->footer('<span class="font-weight-bold">$3000</span>/<span class="text-muted">$5000</span>')
            );
            });

    }

}
