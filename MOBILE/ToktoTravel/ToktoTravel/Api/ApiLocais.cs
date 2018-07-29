using Newtonsoft.Json;
using Newtonsoft.Json.Serialization;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Model;

namespace ToktoTravel.Api
{
   public static class ApiLocais
    {
        public static async Task<List<Locais>> GetAsync()
        {
            using (var client = new HttpClient())
            {
                var  json = await client.GetStringAsync("http://toktotravel.tecnologia.ws/WS/consultaWSL.php");
               var livros = JsonConvert.DeserializeObject<List<Locais>>(json);
               // Console.Write(json);
                return livros;
            }
        }
        public static async Task AddProdutoAsync(Locais locais)
        {
            try
            {
                using (var client = new HttpClient())
                {
                    string url = "http://toktotravel.tecnologia.ws/WS/wslPostData.php";

                    // var uri = new Uri(string.Format(url, produto.Id));
                    if (locais.Avaliacao == null)
                    {
                       
                        url = String.Format("{0}?Nome_loc={1}&Cep_loc={2}&Bairro_loc={3}&Cidade_loc={4}&Desc_local={5}&End_loc={6}&Nro_loc={7}", url, locais.Nome_loc.ToString(), locais.Cep_loc.ToString(), locais.Bairro_loc.ToString(), locais.Cidade_loc.ToString(), locais.Desc_local.ToString(), locais.End_loc.ToString(), locais.Nro_loc.ToString());
                        //var content = new StringContent(data, "application/json");
                    }
                    else
                    {
                        url = String.Format("{0}?Avaliacao={1}&Cod_evento={2}", url, locais.Avaliacao.ToString(), locais.Cod_local.ToString());
                    }
                    var data = JsonConvert.SerializeObject(locais);
                    HttpResponseMessage response = null;
                    if(data != null)
                    {
                        response = await client.PostAsync(url, new StringContent(data));
                        String responseJson = await response.Content.ReadAsStringAsync();
                    }
               

                    if (!response.IsSuccessStatusCode)
                    {
                        throw new Exception("Erro ao incluir local");
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
