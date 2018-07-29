using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Api;
using ToktoTravel.Model;
using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace ToktoTravel.View
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class CadastarLocalView : ContentPage
	{
        VerificarConecxao internet = new VerificarConecxao();

        public CadastarLocalView ()
		{
            InitializeComponent();
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
        private async void Cadastar_Clicked(object sender, EventArgs e)
        {
            Locais novoProduto = new Locais
            {
                Nome_loc = txtNome.Text,
                Cep_loc = txtCep.Text,
                Bairro_loc = txtBairro.Text,
                Cidade_loc = txtCidade.Text,
                Desc_local = txtDescricao.Text,
                End_loc = txtLogradouro.Text,
                Nro_loc = txtNumero.Text
                   
                
                
                



            };

            try
            {
                await Api.ApiLocais.AddProdutoAsync(novoProduto);
                LimparCampos();
               // await DisplayAlert("Cadastro", "Cadastro realizado com sucesso", "OK");
                await Navigation.PushAsync(new SalvarImagemLocalView());
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

       /* private async void image_Clicked(object sender, EventArgs e)
        {
            
        }*/
    }
}