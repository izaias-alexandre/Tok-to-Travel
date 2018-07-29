using System;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using ToktoTravel.View;
using ToktoTravel.Model;

[assembly: XamlCompilation (XamlCompilationOptions.Compile)]
namespace ToktoTravel
{
	public partial class App : Application
	{
        public static MasterDetailPage masterDetail { get; set; }
       

        public App ()
		{
            //InitializeComponent();
            // MainPage = new NavigationPage(new LoginView());
            // MainPage = new NavigationPage(new ToktoTravel.View.BuscaView());
            MainPage = new MainPage();
            //MainPage = new CadastarLocalView();
          
        }

		protected override void OnStart ()
		{
			// Handle when your app starts
		}

		protected override void OnSleep ()
		{
			// Handle when your app sleeps
		}

		protected override void OnResume ()
		{
			// Handle when your app resumes
		}
	}
    [ContentProperty(nameof(Source))]
    public class ImageResourceExtension : IMarkupExtension
    {
        public string Source { get; set; }

        public object ProvideValue(IServiceProvider serviceProvider)
        {
            if (Source == null)
            {
                return null;
            }

            // Do your translation lookup here, using whatever method you require
            var imageSource = ImageSource.FromResource(Source);

            return imageSource;
        }
    }
}
