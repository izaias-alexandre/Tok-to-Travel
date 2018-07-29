using Plugin.ExternalMaps;
using Plugin.Toasts;
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
	public partial class EventosViewDetails : ContentPage
	{
       private double StepValue;
        private int notaAvaliacao;
        private int cod_evento;

      

        public EventosViewDetails (Eventos eventos)
		{
            if (eventos == null)
            {
                throw new ArgumentNullException(nameof(eventos));
            }
            BindingContext = eventos;
            var url = String.Format("https://www.google.com.br/maps/place/{0},+{1}+-+{2},+{3}+-+SP,+0{4}/", eventos.Evento_end, eventos.Evento_nro, eventos.Evento_bairro, eventos.Evento_cidade, eventos.Evento_CEP);

            var nota = Convert.ToDouble(eventos.Nota) / Convert.ToInt32(eventos.Avaliacao);
            
            cod_evento = eventos.Cod_evento;
            InitializeComponent();
            Browser.Source = url;
            this.nota.Text = Math.Round(nota,1).ToString();


            /* Content = new Image
             {
                 Source = ImageSource.FromResource("ToktoTravel.aquariodeSaoPaulo.jpg")
             };*/



        }

        private async void Button_Clicked(object sender, EventArgs e)
        {

            try
            {
                Eventos evento = new Eventos();
                evento.Evento_bairro = bai.Text;
                evento.Evento_CEP = cep.Text;
                evento.Evento_end= end.Text;
                if (evento.Evento_end != null && evento.Evento_CEP != null)
                {
                    //await CrossExternalMaps.Current.NavigateTo("Pça da Sé", -23.5486, -46.6392);
                    await PoeEnderecoNoMapa(evento);
                }
                else
                {
                    return;
                }
            }
            catch (Exception ex)
            {
                await DisplayAlert("Erro : ", ex.Message, "OK");
            }


        }
        private async Task PoeEnderecoNoMapa(Eventos cli)
        {
            string Pais = "BR";
            string CodigoPais = "55";
            string Estado = "SP";
            string cidade = "São Paulo";

            if (string.IsNullOrEmpty(cli.Evento_CEP)
               && string.IsNullOrEmpty(cli.Evento_end) && string.IsNullOrEmpty(cli.Evento_cidade))
            {
                await DisplayAlert("Dados Inválidos", "Faltam dados obrigatórios...", "OK");
            }
            else
            {
                try
                {
                    await CrossExternalMaps.Current.NavigateTo("Teste", cli.Evento_end + "," + cli.Evento_nro, cidade, Estado, "0" + cli.Evento_CEP, Pais, CodigoPais);
                }
                catch (Exception ex)
                {
                    throw ex;
                }
            }
        }

        private void Avalia_ValueChanged(object sender, ValueChangedEventArgs e)
        {
            StepValue = 1.0;

            var newStep = Math.Round(e.NewValue / StepValue);

            Avalia.Value = newStep * StepValue;
            CorfirmaAvalia.IsVisible = true;
            notaAvaliacao = (int)e.NewValue;
            avaliacao.Text = String.Format("Você avaliou com nota:{0}", notaAvaliacao);

        }

        private async void CorfirmaAvalia_Clicked(object sender, EventArgs e)
        {
            
            Avalia.IsVisible = false;

            Eventos novoProduto = new Eventos
            {

                Avaliacao = notaAvaliacao.ToString(),
                Cod_evento = cod_evento
                
            };

            try
            {
                await Api.ApiEventos.AddProdutoAsync(novoProduto);
                CorfirmaAvalia.IsVisible = false;
                await DisplayAlert("Avaliação", "Sua Avaliação está salva", "OK");
                //await Navigation.PushAsync(new SalvarImagemLocalView());
               
            }
            catch (Exception ex)
            {
                await DisplayAlert("Erro", ex.Message, "OK");
            }
        }

        private async Task InfoButton_Toggled(object sender, ToggledEventArgs e)
        {
            if(InfoButton.IsToggled == true)
            {
                var notificator = DependencyService.Get<IToastNotificator>();

                var options = new NotificationOptions()
                {
                    Title = "Dia do Evento",
                    Description = nome.Text,
                    // DelayUntil = 



                };

                var result = await notificator.Notify(options);
            }
            //else
            //{
             //   return;
            //}
           
        }
    }
}