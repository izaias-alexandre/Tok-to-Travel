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
	public partial class Menu : ContentPage
	{
        public List<Model.Menu> Items = new List<Model.Menu>();
        
        public Menu ()
		{
            InitializeComponent();


            Items.Add(new Model.Menu { Nome = "Home", Logo = "home.png" });
            Items.Add(new Model.Menu { Nome = "Eventos", Logo = "calender.png" });
            Items.Add(new Model.Menu { Nome = "Locais",  Logo = "location.png" });
            
       
            


            if (Application.Current.Properties.ContainsKey("valor") && Application.Current.Properties["valor"] != null)
            {
                Items.Add(new Model.Menu { Nome = "Minha Conta" , Logo = "login.png" });
            }
            else
            {
                Items.Add(new Model.Menu { Nome = "Login", Logo = "login.png" });
            }
            Items.Add(new Model.Menu { Nome = "Site Oficial", Logo = "globe.png" });

            ListMenu.ItemsSource = Items;
        }

        private async void ListMenu_ItemSelected(object sender, SelectedItemChangedEventArgs e)
        {
            var item = e.SelectedItem as Model.Menu;
            if(item.Nome == "Eventos")
            {
                App.masterDetail.IsPresented = false;
                await App.masterDetail.Detail.Navigation.PushAsync(new EventosView());
            }
            if(item.Nome == "Locais")
            {
                App.masterDetail.IsPresented = false;
                await App.masterDetail.Detail.Navigation.PushAsync(new LocaisView());
            }
            if (item.Nome == "Login")
            {
                App.masterDetail.IsPresented = false;
                await App.masterDetail.Detail.Navigation.PushAsync(new LoginView());

            }
            if (item.Nome == "Minha Conta")
            {
                App.masterDetail.IsPresented = false;
                await App.masterDetail.Detail.Navigation.PushAsync(new MinhaContaView());

            }
           
            if (item.Nome == "Home")
            {
                App.masterDetail.IsPresented = false;
                await App.masterDetail.Detail.Navigation.PushAsync(new BuscaView());

            }
            if (item.Nome == "Site Oficial")
            {
                var uri = "http://toktotravel.tecnologia.ws";
                Device.OpenUri( new Uri (uri));

            }




        }
    }
}