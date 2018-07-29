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
	public partial class CadastroUsuarioView : ContentPage
	{
        VerificarConecxao internet = new VerificarConecxao();
        public CadastroUsuarioView ()
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

        private async void cadatrar_Clicked(object sender, EventArgs e)
        {

        
        Usuarios novoProduto = new Usuarios
        {
            Nome_user = txtNome.Text,
            Email_user = txtEmail.Text,
            Senha_user = txtSenha.Text







        };

            try
            {
                var logian = await Api.ApiUsuario.AddProdutoAsync(novoProduto);
        LimparCampos();
                await DisplayAlert("Cadastro", "Cadastro realizado com sucesso", "OK");
                if (logian != "erro")
                {
                    if (!Application.Current.Properties.ContainsKey("valor"))
                        Application.Current.Properties["valor"] = logian;
                    else
                        Application.Current.Properties.Add("valor", logian);
                }
                App.masterDetail.Master = new View.Menu();
                // await App.Current.MainPage.Navigation.PushAsync(new NavigationPage(new BuscaView()));
                //await App.masterDetail.Detail.Navigation.PushAsync(new BuscaView());
                App.masterDetail.Detail = new NavigationPage(new BuscaView());
            }
            catch (Exception ex)
            {
                await DisplayAlert("Erro", ex.Message, "OK");
}
        }
        private void LimparCampos()
{
    txtEmail.Text = null;
    txtNome.Text = null;
    txtSenha.Text = null;
  
}
    }
}