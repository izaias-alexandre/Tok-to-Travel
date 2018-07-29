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
	public partial class CadastrarEventoView : ContentPage
	{
        //private string Data;
        //private string Hora;
        VerificarConecxao internet = new VerificarConecxao();
        public CadastrarEventoView ()
		{
			InitializeComponent ();
            if (internet.conn == false)
            {

                SemInternet();
            }

        }
        private void SemInternet()
        {
            //await App.masterDetail.Detail.Navigation.PopAsync();
            //  await DisplayAlert("Erro", "Desculpe Voce não esta Conectado", "OK");
            lista.IsVisible = false;
            this.seminternet.IsVisible = true;
            // App.masterDetail.Detail.Navigation.PushAsync(new SemInternetView());

        }

        private async void cadastar_Clicked(object sender, EventArgs e)
        {
            Eventos novoProduto = new Eventos
            {
                Nome_evento = txtNome.Text,
                Evento_CEP = txtCep.Text,
                Evento_bairro = txtBairro.Text,
                Evento_cidade = txtCidade.Text,
                Desc_evento = txtDescricao.Text,
                Evento_end = txtLogradouro.Text,
                Evento_nro = txtNumero.Text,
                Hr_evento = tpHoraEvento.Time.ToString(),
                Data_evento = String.Format("{0}/{1}/{2}",dpDataEvento.Date.Day, dpDataEvento.Date.Month,dpDataEvento.Date.Year)
              

            };

            try
            {
                await Api.ApiEventos.AddProdutoAsync(novoProduto);
                LimparCampos();
                //await DisplayAlert("Cadastro", "Cadastro realizado com sucesso", "OK");
                await Navigation.PushAsync(new SalvarImagemEventoView());
            }
            catch (Exception ex)
            {
                await DisplayAlert("Erro", ex.Message, "OK");
            }
        }
        private void LimparCampos()
        {
            txtNumero.Text = null;
            txtNome.Text = null;
            txtLogradouro.Text = null;
            txtDescricao.Text = null;
            txtCidade.Text = null;
            txtCep.Text = null;
            txtBairro.Text = null;
        }
         

     
    }
}