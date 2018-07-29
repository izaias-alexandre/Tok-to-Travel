using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Model;

namespace ToktoTravel.Api
{
    public static class ApiEventos
    {
        public static async Task<List<Eventos>> GetAsync()
        {
            try
            {
                using (var client = new HttpClient())
                {
                    var json = await client.GetStringAsync("http://toktotravel.tecnologia.ws/WS/ConsultaWSE.php");
                    var livros = JsonConvert.DeserializeObject<List<Eventos>>(json);
                    // Console.Write(json);
                    return livros;
                }
            }
            catch (Exception )
            {
                throw;
                

            }
        }
        public static async Task AddProdutoAsync(Eventos eventos)
        {
            try
            {
                using (var client = new HttpClient())
                {
                    string url = "http://toktotravel.tecnologia.ws/WS/wsePostData.php";

                    // var uri = new Uri(string.Format(url, produto.Id));
                    if (eventos.Avaliacao == null)
                    {
                      
                        url = String.Format("{0}?Nome_evento={1}&Evento_CEP={2}&Evento_bairro={3}&Evento_cidade={4}&Desc_evento={5}&Evento_end={6}&Evento_nro={7}&Hr_evento={8}&Data_evento={9}", url, eventos.Nome_evento.ToString(), eventos.Evento_CEP.ToString(), eventos.Evento_bairro.ToString(), eventos.Evento_cidade.ToString(), eventos.Desc_evento.ToString(), eventos.Evento_end.ToString(), eventos.Evento_nro.ToString(), eventos.Hr_evento.ToString(), eventos.Data_evento.ToString());
                        //var content = new StringContent(data, "application/json");
                    }
                    else
                    {
                        url = String.Format("{0}?Avaliacao={1}&Cod_evento={2}", url, eventos.Avaliacao.ToString(),eventos.Cod_evento.ToString());
                    }
                    var data = JsonConvert.SerializeObject(eventos);
                    HttpResponseMessage response = null;
                    if (data != null)
                    {
                        response = await client.PostAsync(url, new StringContent(data));
                        String responseJson = await response.Content.ReadAsStringAsync();
                    }


                    if (!response.IsSuccessStatusCode)
                    {
                        throw new Exception("Erro ao incluir evento");
                    }

                }
            }
            catch (HttpRequestException e)
            {
                System.Diagnostics.Debug.WriteLine(e);
            }
        }
    }
}
