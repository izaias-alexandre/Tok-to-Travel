using Plugin.ExternalMaps;
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
	public partial class LocaisViewDetails : ContentPage
    {
        private double StepValue;
        private int notaAvaliacao;
        private int cod_local;

        public LocaisViewDetails(Locais local)
        {
            if (local == null)
            {
                throw new ArgumentNullException(nameof(local));
            }
            BindingContext = local;
            var url = String.Format("https://www.google.com.br/maps/place/{0},+{1}+-+{2},+{3}+-+SP,+0{4}/", local.End_loc, local.Nro_loc, local.Bairro_loc, local.Cidade_loc, local.Cep_loc);

            var nota = Convert.ToDouble(local.Nota) / Convert.ToInt32(local.Avaliacao);

            cod_local = local.Cod_local;
            InitializeComponent();
            Browser.Source = url;
            this.nota.Text = Math.Round(nota, 1).ToString();




            /* Content = new Image
             {
                 Source = ImageSource.FromResource("ToktoTravel.aquariodeSaoPaulo.jpg")
             };*/



        }

        private async void Button_Clicked(object sender, EventArgs e)
        {
           
            try
            {
                Locais local = new Locais();
                local.Bairro_loc = bai.Text;
                local.Cep_loc = cep.Text;
                local.End_loc = end.Text;
                if (local.End_loc != null && local.Cep_loc != null)
                {
                    //await CrossExternalMaps.Current.NavigateTo("Pça da Sé", -23.5486, -46.6392);
                    await PoeEnderecoNoMapa(local);
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
        private async Task PoeEnderecoNoMapa(Locais cli)
        {
            string Pais = "BR";
            string CodigoPais = "55";
            string Estado = "SP";
            string cidade = "São Paulo";

            if (string.IsNullOrEmpty(cli.Cep_loc)
               && string.IsNullOrEmpty(cli.End_loc) && string.IsNullOrEmpty(cli.Cidade_loc))
            {
                await DisplayAlert("Dados Inválidos", "Faltam dados obrigatórios...", "OK");
            }
            else
            {
                try
                {
                    await CrossExternalMaps.Current.NavigateTo("Teste", cli.End_loc+","+cli.Nro_loc, cidade, Estado, "0"+cli.Cep_loc, Pais, CodigoPais);
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

            Locais novoProduto = new Locais
            {

                Avaliacao = notaAvaliacao.ToString(),
                Cod_local = cod_local

            };

            try
            {
                await Api.ApiLocais.AddProdutoAsync(novoProduto);
                CorfirmaAvalia.IsVisible = false;
                await DisplayAlert("Avaliação", "Sua Avaliação está salva", "OK");
                //await Navigation.PushAsync(new SalvarImagemLocalView());

            }
            catch (Exception ex)
            {
                await DisplayAlert("Erro", ex.Message, "OK");
            }
        }
    }
}