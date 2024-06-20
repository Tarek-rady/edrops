<?php

namespace App\Providers;

        use App\Repositories\Sql\PointRepository;
        use App\Repositories\Contract\PointRepositoryInterface;

        use App\Repositories\Sql\CartRepository;
        use App\Repositories\Contract\CartRepositoryInterface;

        use App\Repositories\Sql\PayoutRequestRepository;
        use App\Repositories\Contract\PayoutRequestRepositoryInterface;

        use App\Repositories\Sql\ProfitAppRepository;
        use App\Repositories\Contract\ProfitAppRepositoryInterface;

        use App\Repositories\Sql\StockRepository;
        use App\Repositories\Contract\StockRepositoryInterface;

        use App\Repositories\Sql\TermsRepository;
        use App\Repositories\Contract\TermsRepositoryInterface;

        use App\Repositories\Sql\SallerRepository;
        use App\Repositories\Contract\SallerRepositoryInterface;

        use App\Repositories\Sql\CountryRepository;
        use App\Repositories\Contract\CountryRepositoryInterface;

        use App\Repositories\Sql\CurrencyRepository;
        use App\Repositories\Contract\CurrencyRepositoryInterface;

        use App\Repositories\Sql\ArticalRepository;
        use App\Repositories\Contract\ArticalRepositoryInterface;

        use App\Repositories\Sql\CompanyRepository;
        use App\Repositories\Contract\CompanyRepositoryInterface;

        use App\Repositories\Sql\ProjectPaymentRepository;
        use App\Repositories\Contract\ProjectPaymentRepositoryInterface;

        use App\Repositories\Sql\ProjectRepository;
        use App\Repositories\Contract\ProjectRepositoryInterface;

        use App\Repositories\Sql\TaskRepository;
        use App\Repositories\Contract\TaskRepositoryInterface;

        use App\Repositories\Sql\SectionRepository;
        use App\Repositories\Contract\SectionRepositoryInterface;

        use App\Repositories\Sql\BranchRepository;
        use App\Repositories\Contract\BranchRepositoryInterface;

        use App\Repositories\Sql\AddRepository;
        use App\Repositories\Contract\AddRepositoryInterface;

        use App\Repositories\Sql\AdminTransectionRepository;
        use App\Repositories\Contract\AdminTransectionRepositoryInterface;

        use App\Repositories\Sql\AppRatioRepository;
        use App\Repositories\Contract\AppRatioRepositoryInterface;

        use App\Repositories\Sql\PackageRepository;
        use App\Repositories\Contract\PackageRepositoryInterface;

        use App\Repositories\Sql\RopertRepository;
        use App\Repositories\Contract\RopertRepositoryInterface;

        use App\Repositories\Sql\ClintCouponRepository;
        use App\Repositories\Contract\ClintCouponRepositoryInterface;

        use App\Repositories\Sql\TripDriverRepository;
        use App\Repositories\Contract\TripDriverRepositoryInterface;

        use App\Repositories\Sql\TripStatusRepository;
        use App\Repositories\Contract\TripStatusRepositoryInterface;

        use App\Repositories\Sql\DriverStatusRepository;
        use App\Repositories\Contract\DriverStatusRepositoryInterface;

        use App\Repositories\Sql\OrderStatusRepository;
        use App\Repositories\Contract\OrderStatusRepositoryInterface;

        use App\Repositories\Sql\RateRepository;
        use App\Repositories\Contract\RateRepositoryInterface;

        use App\Repositories\Sql\TripRepository;
        use App\Repositories\Contract\TripRepositoryInterface;

        use App\Repositories\Sql\DriverRepository;
        use App\Repositories\Contract\DriverRepositoryInterface;

        use App\Repositories\Sql\CarTypeRepository;
        use App\Repositories\Contract\CarTypeRepositoryInterface;

        use App\Repositories\Sql\CityRepository;
        use App\Repositories\Contract\CityRepositoryInterface;

        use App\Repositories\Sql\CategoryRepository;
        use App\Repositories\Contract\CategoryRepositoryInterface;

        use App\Repositories\Sql\RoleRepository;
        use App\Repositories\Contract\RoleRepositoryInterface;

        use App\Repositories\Sql\FeautureRepository;
        use App\Repositories\Contract\FeautureRepositoryInterface;

        use App\Repositories\Sql\NotificationRepository;
        use App\Repositories\Contract\NotificationRepositoryInterface;

        use App\Repositories\Sql\OrderRepository;
        use App\Repositories\Contract\OrderRepositoryInterface;

        use App\Repositories\Sql\SettingRepository;
        use App\Repositories\Contract\SettingRepositoryInterface;

        use App\Repositories\Sql\ContactUsRepository;
        use App\Repositories\Contract\ContactUsRepositoryInterface;

        use App\Repositories\Sql\StaticPageRepository;
        use App\Repositories\Contract\StaticPageRepositoryInterface;

        use App\Repositories\Sql\CareerApllyRepository;
        use App\Repositories\Contract\CareerApllyRepositoryInterface;

        use App\Repositories\Sql\SubCategoryRepository;
        use App\Repositories\Contract\SubCategoryRepositoryInterface;

        use App\Repositories\Sql\CareerRepository;
        use App\Repositories\Contract\CareerRepositoryInterface;

        use App\Repositories\Sql\BrandRepository;
        use App\Repositories\Contract\BrandRepositoryInterface;

        use App\Repositories\Sql\NewsRepository;
        use App\Repositories\Contract\NewsRepositoryInterface;

        use App\Repositories\Sql\ClintRepository;
        use App\Repositories\Contract\ClintRepositoryInterface;

        use App\Repositories\Sql\ContactCompanyRepository;
        use App\Repositories\Contract\ContactCompanyRepositoryInterface;

        use App\Repositories\Sql\CouponRepository;
        use App\Repositories\Contract\CouponRepositoryInterface;



    use App\Repositories\Sql\CustomerRepository;
    use App\Repositories\Contract\CustomerRepositoryInterface;






use App\Repositories\Sql\UserRepository;
use App\Repositories\Contract\UserRepositoryInterface;



use App\Repositories\Contract\BaseRepositoryInterface;
// repository

use App\Repositories\Sql\BaseRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{

    public function register(){

        $this->app->bind(PointRepositoryInterface::class, PointRepository::class);

        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);

        $this->app->bind(PayoutRequestRepositoryInterface::class, PayoutRequestRepository::class);

        $this->app->bind(ProfitAppRepositoryInterface::class, ProfitAppRepository::class);

        $this->app->bind(StockRepositoryInterface::class, StockRepository::class);

        $this->app->bind(TermsRepositoryInterface::class, TermsRepository::class);

        $this->app->bind(SallerRepositoryInterface::class, SallerRepository::class);

        $this->app->bind(CountryRepositoryInterface::class, CountryRepository::class);

        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);

        $this->app->bind(ArticalRepositoryInterface::class, ArticalRepository::class);

        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);

        $this->app->bind(ProjectPaymentRepositoryInterface::class, ProjectPaymentRepository::class);

        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);

        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);

        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);

        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);

        $this->app->bind(AddRepositoryInterface::class, AddRepository::class);

        $this->app->bind(AdminTransectionRepositoryInterface::class, AdminTransectionRepository::class);

        $this->app->bind(AppRatioRepositoryInterface::class, AppRatioRepository::class);

        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);

        $this->app->bind(RopertRepositoryInterface::class, RopertRepository::class);

        $this->app->bind(ClintCouponRepositoryInterface::class, ClintCouponRepository::class);

        $this->app->bind(TripDriverRepositoryInterface::class, TripDriverRepository::class);

        $this->app->bind(TripStatusRepositoryInterface::class, TripStatusRepository::class);

        $this->app->bind(DriverStatusRepositoryInterface::class, DriverStatusRepository::class);

        $this->app->bind(OrderStatusRepositoryInterface::class, OrderStatusRepository::class);

        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);

        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);

        $this->app->bind(DriverRepositoryInterface::class, DriverRepository::class);

        $this->app->bind(CarTypeRepositoryInterface::class, CarTypeRepository::class);

        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);

        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);

        $this->app->bind(FeautureRepositoryInterface::class, FeautureRepository::class);

        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);

        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);

        $this->app->bind(ContactUsRepositoryInterface::class, ContactUsRepository::class);

        $this->app->bind(StaticPageRepositoryInterface::class, StaticPageRepository::class);

        $this->app->bind(CareerApllyRepositoryInterface::class, CareerApllyRepository::class);

        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);

        $this->app->bind(CareerRepositoryInterface::class, CareerRepository::class);

        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);

        $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);

        $this->app->bind(ClintRepositoryInterface::class, ClintRepository::class);

        $this->app->bind(ContactCompanyRepositoryInterface::class, ContactCompanyRepository::class);

        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);



        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);






        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
    }

    public function boot()
    {
        //
    }
}
