<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\{Student, Teacher, User};
use Illuminate\Http\Request;
use Illuminate\Support\{Facades\Hash, ServiceProvider};
use Laravel\Fortify\Fortify;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        Fortify::authenticateUsing(function(Request $request) {

            if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $user = User::where('email', $request->email)->with(['teacher', 'student'])->first();

                if (!empty($user->student) && $user->student->active != 1 && !$user->teacher)
                    return false;

            } else {
                // Its ID Actually
                $teach = Teacher::where('nip', $request->email)->with('user')->first();
                $siswa = Student::with('user')->where('active', 1)->find($request->email);

                if ($teach) $user = $teach->user;
                else if ($siswa) $user = $siswa->user;
                else return false;

            }


            // Verify
            if ($user && Hash::check($request->password, $user->password))
                return $user;

        });

    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
