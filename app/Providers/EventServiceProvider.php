<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\OtherDeviceLogout;
use App\Events\Auth\DeactivateAccount;

use App\Listeners\Auth\LoginListener;
use App\Listeners\Auth\LogoutListener;
use App\Listeners\Auth\OtherDeviceLogoutListener;
use App\Listeners\Auth\DeactivateAccountListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LoginListener::class,
        ],
        Logout::class => [
            LogoutListener::class,
        ],
        OtherDeviceLogout::class => [
            OtherDeviceLogoutListener::class,
        ],
        DeactivateAccount::class => [
            DeactivateAccountListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (!app()->runningInConsole()) {

            \App\Models\General\User::observe(\App\Observers\General\UserObserver::class);
            \App\Models\General\Role::observe(\App\Observers\General\RoleObserver::class);
            \App\Models\General\Setting::observe(\App\Observers\General\SettingObserver::class);

            \App\Models\Cms\ImageX::observe(\App\Observers\Cms\MediaObserver::class);
            \App\Models\Cms\Page\Page::observe(\App\Observers\Cms\PageObserver::class);
            \App\Models\Cms\Page\SectionContent::observe(\App\Observers\Cms\SectionContentObserver::class);
            \App\Models\Cms\Slider::observe(\App\Observers\Cms\SliderObserver::class);

            \App\Models\Addons\Faq::observe(\App\Observers\Addons\FaqObserver::class);
            \App\Models\Addons\QuickLink::observe(\App\Observers\Addons\QuickLinkObserver::class);
            \App\Models\Addons\SocialMedia::observe(\App\Observers\Addons\SocialMediaObserver::class);
            \App\Models\Addons\Team::observe(\App\Observers\Addons\TeamObserver::class);
            \App\Models\Addons\Author::observe(\App\Observers\Addons\AuthorObserver::class);
            \App\Models\Addons\Partner::observe(\App\Observers\Addons\PartnerObserver::class);
            \App\Models\Cms\Popup\Popup::observe(\App\Observers\Cms\PopupObserver::class);
            \App\Models\Addons\Testimonial::observe(\App\Observers\Addons\TestimonialObserver::class);
            \App\Models\Addons\Blog\Blog::observe(\App\Observers\Addons\BlogObserver::class);
            \App\Models\Addons\Blog\BlogCategory::observe(\App\Observers\Addons\BlogCategoryObserver::class);

            \App\Models\Build\ListGroup::observe(\App\Observers\Build\ListGroupObserver::class);
            \App\Models\Build\SectionConfigBuild::observe(\App\Observers\Build\SectionConfigBuildObserver::class);

            //ecommerce
            \App\Models\Ecommerce\Area::observe(\App\Observers\Ecommerce\AreaObserver::class);
            \App\Models\Ecommerce\City::observe(\App\Observers\Ecommerce\CityObserver::class);
            \App\Models\Ecommerce\Region::observe(\App\Observers\Ecommerce\RegionObserver::class);
            \App\Models\Ecommerce\Country::observe(\App\Observers\Ecommerce\CountryObserver::class);
            \App\Models\Ecommerce\Category::observe(\App\Observers\Ecommerce\CategoryObserver::class);
            \App\Models\Ecommerce\Brand::observe(\App\Observers\Ecommerce\BrandObserver::class);
            \App\Models\Ecommerce\Color::observe(\App\Observers\Ecommerce\ColorObserver::class);
            \App\Models\Ecommerce\ColorGroup::observe(\App\Observers\Ecommerce\ColorGroupObserver::class);
            \App\Models\Ecommerce\Size::observe(\App\Observers\Ecommerce\SizeObserver::class);
            \App\Models\Ecommerce\Currency::observe(\App\Observers\Ecommerce\CurrencyObserver::class);
            \App\Models\Ecommerce\ExchangeRate::observe(\App\Observers\Ecommerce\ExchangeRateObserver::class);
            \App\Models\Ecommerce\Product\Product::observe(\App\Observers\Ecommerce\ProductObserver::class);
            \App\Models\Ecommerce\PromoCode\PromoCode::observe(\App\Observers\Ecommerce\PromoCodeObserver::class);
            \App\Models\Ecommerce\Collection\Collection::observe(\App\Observers\Ecommerce\CollectionObserver::class);
            \App\Models\Ecommerce\Offer\Offer::observe(\App\Observers\Ecommerce\OfferObserver::class);
            \App\Models\Ecommerce\GiftVoucher\GiftVoucher::observe(\App\Observers\Ecommerce\GiftVoucherObserver::class);
            \App\Models\Ecommerce\ProductReview::observe(\App\Observers\Ecommerce\ProductReviewObserver::class);
            \App\Models\Ecommerce\Order\Order::observe(\App\Observers\Ecommerce\Order\OrderObserver::class);
            \App\Models\Ecommerce\Order\OrderStatus::observe(\App\Observers\Ecommerce\Order\OrderStatusObserver::class);
            \App\Models\Ecommerce\Order\OrderDetail::observe(\App\Observers\Ecommerce\Order\OrderDetailObserver::class);
            \App\Models\Ecommerce\Policy::observe(\App\Observers\Ecommerce\PolicyObserver::class);
            \App\Models\Ecommerce\Customer::observe(\App\Observers\Ecommerce\CustomerObserver::class);
            \App\Models\Ecommerce\Delivery\Delivery::observe(\App\Observers\Ecommerce\DeliveryObserver::class);
        }
    }
}
