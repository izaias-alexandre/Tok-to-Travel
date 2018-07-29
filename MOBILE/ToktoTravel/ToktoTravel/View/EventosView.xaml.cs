using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Model;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace ToktoTravel.View
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class EventosView : ContentPage
	{
        VerificarConecxao internet = new VerificarConecxao();
        public  EventosView()
		{
            InitializeComponent();

            if (internet.conn == false)
            {
               
                SemInternet();
            }
            else
            {
                this.BindingContext = new ViewModel.EventosViewModel();

               
            }
            


        }
        private  void SemInternet()
        {
            //await App.masterDetail.Detail.Navigation.PopAsync();
            //  await DisplayAlert("Erro", "Desculpe Voce não esta Conectado", "OK");
            lista.IsVisible = false;
            this.seminternet.IsVisible = true;
            // App.masterDetail.Detail.Navigation.PushAsync(new SemInternetView());
            
        }

        private async void MenuItem1_Activated(object sender, EventArgs e)
        {
            await App.masterDetail.Detail.Navigation.PushAsync(new View.PesquisaEventosView());
        }

        private async void lista_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            var evento = e.SelectedItem as Eventos;

            await Navigation.PushAsync(new EventosViewDetails(evento));
        }

       

        private async void MenuItem2_Activated(object sender, EventArgs e)
        {
            await App.masterDetail.Detail.Navigation.PushAsync(new View.CadastrarEventoView());
        }
    }
}