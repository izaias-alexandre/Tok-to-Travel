using Plugin.Media;
using Plugin.Media.Abstractions;
using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;

using Xamarin.Forms;
using Xamarin.Forms.Xaml;

namespace ToktoTravel.View
{
	[XamlCompilation(XamlCompilationOptions.Compile)]
	public partial class SalvarImagemEventoView : ContentPage
    {
        private MediaFile _mediaFile;

        public SalvarImagemEventoView ()
		{
			InitializeComponent ();
            

        }

        private async void camera_Clicked(object sender, EventArgs e)
        {
            await CrossMedia.Current.Initialize();
            if (!CrossMedia.Current.IsPickPhotoSupported)
            {
                await DisplayAlert("Galeria", "Este aparelho não tem suporte acessar galeria.", "OK");
                return;
            }
            
            _mediaFile = await CrossMedia.Current.PickPhotoAsync();

            if (_mediaFile == null)
            {
                return;
            }
           
            //LocalPathLabel.Text = _mediaFile.Path;
            actInd.IsRunning = true;
            FileImage.Source = ImageSource.FromStream(() => {
                return _mediaFile.GetStream();
            });
            actInd.IsRunning = false;
        }

        private async void upload_Clicked(object sender, EventArgs e)
        {
            actInd.IsRunning = true;
              var content = new MultipartFormDataContent();
            content.Add(new StreamContent(_mediaFile.GetStream()),
                        "\"file\"",
                        $"\"{ _mediaFile.Path.Trim()}\"");

            var client = new HttpClient();
            var uploadServiceBaseAddress = "http://toktotravel.tecnologia.ws/WS/wsePostData.php";
            var httpResponseMessage = await client.PostAsync(uploadServiceBaseAddress, content);

            actInd.IsRunning = false;

            if (httpResponseMessage.IsSuccessStatusCode)
            {
              
                await DisplayAlert("Cadastro", "Obrigado por sua contribuição", "OK");
                await Navigation.PushAsync(new CadastrarEventoView());
            }
            else
            {
                
                await DisplayAlert("Erro", "Erro não foi possivel salvar a imagem", "OK");
            }

        }

        private async void sem_Clicked(object sender, EventArgs e)
        {
            await App.masterDetail.Detail.Navigation.PushAsync(new EventosView());
        }

        private async void galeria_Clicked(object sender, EventArgs e)
        {
            await CrossMedia.Current.Initialize();

            if (!CrossMedia.Current.IsCameraAvailable || !CrossMedia.Current.IsTakePhotoSupported)
            {
                await DisplayAlert("Camera", "Não a Suporte para acessar Camera.", "OK");
                return;
            }
            _mediaFile = await CrossMedia.Current.TakePhotoAsync(new StoreCameraMediaOptions
            {
                Directory = "Sample",
                Name = "myImage.jpg"
            });

            if (_mediaFile == null)
                return;

            //LocalPathLabel.Text = _mediaFile.Path;
            actInd.IsRunning = true;
            FileImage.Source = ImageSource.FromStream(() => {
                return _mediaFile.GetStream();
            });
            actInd.IsRunning = false;
        }
       
    }
}