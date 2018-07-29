using System;
using System.Collections.Generic;
using System.Globalization;
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
    public partial class PesquisaLocaisView : ContentPage

    {

        VerificarConecxao internet = new VerificarConecxao();
       LocaisService cS = new LocaisService();
       // LocaisViewModel service = new LocaisViewModel();
        public List<Locais> _locais;
        
        public async void CarregarList()
        {
            //  this._locais = await cS.Localiza();
            this._locais = await Api.ApiLocais.GetAsync();

        }
        public IEnumerable<Locais> Listar(string filtro = "")
        {
           
            IEnumerable<Locais> livrosFiltrados = this._locais;
            if (!string.IsNullOrEmpty(filtro))
            {

                filtro = RemoveAcentos(filtro);
                livrosFiltrados = this._locais.Where(l => (RemoveAcentos(l.Nome_loc).ToLower().Contains(filtro.ToLower()) || RemoveAcentos(l.End_loc).ToLower().Contains(filtro.ToLower())));
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

        public PesquisaLocaisView()
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
                this.lvwLocais.IsVisible = false;
                this.lvwLocais.ItemsSource = this.Listar(e.NewTextValue);
                this.lvwLocais.IsVisible = true;
            }
            else
            {
               
                this.lvwLocais.ItemsSource = _locais;
               
            }
          

        }
      
        public void SeachBar_Clicked(object sender, EventArgs e)
        {
            this.lvwLocais.IsVisible = false;
            this.lvwLocais.ItemsSource = this.Listar(this.btnBusca.Text);
            this.lvwLocais.IsVisible = true;
        }
         public async void lvwLocais_ItemSelected(object sender, SelectedItemChangedEventArgs e)
          {
              if(e.SelectedItem == null)
              return;

              var local = e.SelectedItem as Locais;

              await Navigation.PushAsync(new LocaisViewDetails(local));
          }
    }
}


