using System;

using Android.App;
using Android.Content.PM;
using Android.Runtime;
using Android.Views;
using Android.Widget;
using Android.OS;
using Plugin.Media;
using Xamarin.Forms;
using Plugin.Toasts;
using Plugin.Permissions;
using Plugin.CurrentActivity;

namespace ToktoTravel.Droid
{
    [Activity(Label = "ToktoTravel", Icon = "@drawable/logo", Theme = "@style/MainTheme", MainLauncher = true, ConfigurationChanges = ConfigChanges.ScreenSize | ConfigChanges.Orientation)]
    public class MainActivity : global::Xamarin.Forms.Platform.Android.FormsAppCompatActivity
    {
        protected override async void OnCreate(Bundle bundle)
        {
            TabLayoutResource = Resource.Layout.Tabbar;
            ToolbarResource = Resource.Layout.Toolbar;

            base.OnCreate(bundle);

            await CrossMedia.Current.Initialize();
            CrossCurrentActivity.Current.Init(this, bundle);

            global::Xamarin.Forms.Forms.Init(this, bundle);

            DependencyService.Register<ToastNotification>(); 
            ToastNotification.Init(this);

            LoadApplication(new App());
        }
        public override void OnRequestPermissionsResult(int requestCode, string[] permissions, Permission[] grantResults)
        {
            PermissionsImplementation.Current.OnRequestPermissionsResult(requestCode, permissions, grantResults);
        }
    }
}

