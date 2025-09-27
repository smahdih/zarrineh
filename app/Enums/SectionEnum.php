<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum SectionEnum: string implements HasLabel
{
    // تولید
    case Plater = 'plater';
    case Laser = 'laser';
    case Calender = 'calender';
    case Cutting = 'cutting';
    case Sewing = 'sewing';
    case Press = 'press';
    case Packaging = 'packaging';
    case SilkPrinting = 'silk-printing';
    case StencilPhotography = 'stencil-photography';

    // اداری
    case Management = 'management';
    case Design = 'design';
    case Accounting = 'accounting';

    // انبارداری
    case WarehouseRawMaterial = 'warehouse-raw-material';
    case WarehouseProducts = 'warehouse-products';

    public function getLabel(): string
    {
        return match ($this) {
            // تولید
            self::Plater => 'پلاتر',
            self::Laser => 'لیزر',
            self::Calender => 'کلندر',
            self::Cutting => 'برش',
            self::Sewing => 'خیاطی',
            self::Press => 'پرس',
            self::Packaging => 'بسته بندی',
            self::SilkPrinting => 'چاپ سیلک',
            self::StencilPhotography => 'عکاسی شابلون',
            // اداری
            self::Management => 'مدیریت',
            self::Design => 'طراحی',
            self::Accounting => 'حسابداری',
            // انبارداری
            self::WarehouseRawMaterial => 'انبار - مواد اولیه',
            self::WarehouseProducts => 'انبار - محصولات',
        };
    }
}
