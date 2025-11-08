app/Providers/AppServiceProvider.php ichida:
use Illuminate\Support\Facades\URL;

public function boot()
{
    if (config('app.env') !== 'local') {
        URL::forceScheme('https');
    }
}
Agar keyin proyektni haqiqiy hostingga chiqarganda, shu qatorni if bilan o‘rash kere
