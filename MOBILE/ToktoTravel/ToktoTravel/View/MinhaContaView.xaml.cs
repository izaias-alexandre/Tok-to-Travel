using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace ToktoTravel.View
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class MinhaContaView : ContentPage
	{
		public MinhaContaView ()
		{
			InitializeComponent ();
		}

        private  void Button_Clicked(object sender, EventArgs e)
        {

            //Application.Current.Properties.Remove("valor");
            Application.Current.Properties["valor"] = null;
            App.masterDetail.Master = new Menu();
            //await App.masterDetail.Detail.Navigation.PushAsync(new BuscaView());

            App.masterDetail.Detail = new NavigationPage(new BuscaView());
        }
    }
}