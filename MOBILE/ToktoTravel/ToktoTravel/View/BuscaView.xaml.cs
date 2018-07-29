using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.ViewModel;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace ToktoTravel.View
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class BuscaView : ContentPage
	{
        //LocaisViewModel list = new ViewModel.LocaisViewModel();
        public BuscaView()
		{
         
            InitializeComponent();

            

            /*  this.listaLocais.ItemTapped += async(sender, e) => {
                  var locais = e.Item as Model.Locais;
                  await App.Current.MainPage.Navigation.PushAsync(new View.DetalhesView(locais));
              };*/
        }

        async void OnTapGestureRecognizerTapped(object sender, EventArgs args)
        {
            var imageSender = (Image)sender;
            // Do something
             await App.masterDetail.Detail.Navigation.PushAsync(new View.LocaisView());
        }

        private  async void btnLocais_Clicked(object sender, EventArgs e)
        {
          
            // App.Current.MainPage.Navigation.PushAsync(new View.LocaisView());
            await App.masterDetail.Detail.Navigation.PushAsync(new View.LocaisView());

        }

        private async  void btnEventos_Clicked(object sender, EventArgs e)
        {

            //App.Current.MainPage.Navigation.PushAsync(new View.EventosView());
            await App.masterDetail.Detail.Navigation.PushAsync(new View.EventosView());
        }

        private async void TapGestureRecognizer_Tapped(object sender, EventArgs e)
        {
            var imageSender = (Image)sender;
            // Do something
            await App.masterDetail.Detail.Navigation.PushAsync(new View.EventosView());
        }

        private void TapGestureRecognizer_Tapped_1(object sender, EventArgs e)
        {
            var uri = "http://toktotravel.tecnologia.ws";
            Device.OpenUri(new Uri(uri));
        }
    }
}