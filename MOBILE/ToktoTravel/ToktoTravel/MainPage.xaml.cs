using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Xamarin.Forms;

namespace ToktoTravel
{
	public partial class MainPage : MasterDetailPage
	{
		public MainPage()
		{
			InitializeComponent();
            this.Master = new View.Menu();
            this.Detail = new NavigationPage( new View.BuscaView());

            App.masterDetail = this;
		}
	}
}
