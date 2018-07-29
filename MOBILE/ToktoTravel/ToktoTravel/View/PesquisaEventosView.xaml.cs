using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Model;
using ToktoTravel.Service;
using ToktoTravel.ViewModel;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace ToktoTravel.View
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class PesquisaEventosView : ContentPage
	{
        VerificarConecxao internet = new VerificarConecxao();
        EventosService service = new EventosService(); 
        public List<Eventos> _eventos;

        public async void CarregarList()
        {
            this._eventos =  await Api.ApiEventos.GetAsync();
            //this._eventos = await service.Localiza();

        }
        public IEnumerable<Eventos> Listar(string filtro = "")
        {

            IEnumerable<Eventos> livrosFiltrados = this._eventos;
            if (!string.IsNullOrEmpty(filtro))
            {

                filtro = RemoveAcentos(filtro);

                livrosFiltrados = this._eventos.Where(e => RemoveAcentos(e.Nome_evento).ToLower().Contains(filtro.ToLower()));/* || e.Evento_end.ToLower().Contains(filtro.ToLower()));*/
            }
            else
            {
                livrosFiltrados = null;
            }

            return livrosFiltrados;


        }
        public static string RemoveAcentos(string texto)
        {
            string comAcentos = "ÄÅÁÂÀÃäáâàãÉÊËÈéêëèÍÎÏÌíîïìÖÓÔÒÕöóôòõÜÚÛüúûùÇç";
            string semAcentos = "AAAAAAaaaaaEEEEeeeeIIIIiiiiOOOOOoooooUUUuuuuCc";

            for (int i = 0; i < comAcentos.Length; i++)
            {
                texto = texto.Replace(comAcentos[i].ToString(), semAcentos[i].ToString());
            }
            return texto;
        }

        public PesquisaEventosView()
        {
            InitializeComponent();

            if (internet.conn == false)
            {

                SemInternet();
            }
            else
            {
                CarregarList();
            }
            


        }

        private void SemInternet()
        {
            //await App.masterDetail.Detail.Navigation.PopAsync();
            //  await DisplayAlert("Erro", "Desculpe Voce não esta Conectado", "OK");
            btnBusca.IsVisible = false;
            this.seminternet.IsVisible = true;
            // App.masterDetail.Detail.Navigation.PushAsync(new SemInternetView());

        }

        private void SeachBar_TextChanged(object sender, TextChangedEventArgs e)
        {


            if (!string.IsNullOrEmpty(e.NewTextValue))
            {
                this.lvwEventos.IsVisible = false;
                this.lvwEventos.ItemsSource = this.Listar(e.NewTextValue);
                this.lvwEventos.IsVisible = true;
            }
            else
            {
                
                this.lvwEventos.ItemsSource = _eventos;

            }


        }

        public void SeachBar_Clicked(object sender, EventArgs e)
        {
            this.lvwEventos.IsVisible = false;
            this.lvwEventos.ItemsSource = this.Listar(this.btnBusca.Text);
            this.lvwEventos.IsVisible = true;
        }
        public async void lvwEventos_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            if (e.SelectedItem == null)
                return;

            var evento = e.SelectedItem as Eventos;

            await Navigation.PushAsync(new EventosViewDetails(evento));
        }
    }
}