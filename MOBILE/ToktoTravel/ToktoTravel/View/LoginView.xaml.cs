using Newtonsoft.Json.Linq;
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
	public partial class LoginView : ContentPage
	{
        public List<Usuarios> _usuario;
        Usuarios u = new Usuarios();
        VerificarConecxao internet = new VerificarConecxao();
        public async void CarregarList()
        {
            this._usuario = await Api.ApiUsuario.GetAsync();
          //  u = this._usuario[].Nome_user;
            //this._eventos = await service.Localiza();

        }
        public LoginView ()
		{
			InitializeComponent ();
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
            lista.IsVisible = false;
            this.seminternet.IsVisible = true;
            // App.masterDetail.Detail.Navigation.PushAsync(new SemInternetView());

        }
        public IEnumerable<Usuarios> Logar(string email,string senha)
        {

            IEnumerable<Usuarios> livrosFiltrados;
            

            if (!string.IsNullOrEmpty(email) || !string.IsNullOrEmpty(senha))
            {

                livrosFiltrados = this._usuario.Where(e =>e.Email_user == email && e.Senha_user == senha);
                //listAuth = this._usuario.Where(e => e.Email_user == email && e.Senha_user == senha).FirstOrDefault();
               
                if (livrosFiltrados.Count() < 1)
                {
                    livrosFiltrados = null;
                }
                else
                {
                    if (Application.Current.Properties.ContainsKey("valor"))
                        Application.Current.Properties["valor"] = this.login.Text;
                    else
                        Application.Current.Properties.Add("valor", this.login.Text);
                }
            

            }
            else
            {
                livrosFiltrados = null;
            }

            return livrosFiltrados;


        }

        private   void Button_Clicked(object sender, EventArgs e)
        {
            var login = this.login.Text;
            var senha = this.senha.Text;

            var resultado = Logar(login, senha);
            if(resultado == null)
            {
                this.msg.IsVisible = true;
                this.msg.Text = "Email ou senha Inválidos";
            }
            else
            {




                
                 App.masterDetail.Master = new View.Menu();
                //await App.Current.MainPage.Navigation.PushAsync(new NavigationPage(new BuscaView()));
                //await App.masterDetail.Detail.Navigation.PushAsync(new BuscaView());
                App.masterDetail.Detail = new NavigationPage(new BuscaView());
            }
        }

        private async void link_Clicked(object sender, EventArgs e)
        {
            await App.masterDetail.Detail.Navigation.PushAsync(new CadastroUsuarioView());
        }
    }
}