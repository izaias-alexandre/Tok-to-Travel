using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using ToktoTravel.Model;

namespace ToktoTravel.Api
{
    public static class ApiUsuario
    {
        public static async Task<List<Usuarios>> GetAsync()
        {
            using (var client = new HttpClient())
            {
                var json = await client.GetStringAsync("http://toktotravel.tecnologia.ws/WS/ConsultaWSU.php");
                var livros = JsonConvert.DeserializeObject<List<Usuarios>>(json);
                // Console.Write(json);
                return livros;
            }
        }
        public static async  Task<String> AddProdutoAsync(Usuarios usuarios)
        {
            try
            {
                using (var client = new HttpClient())
                {
                    string url = "http://toktotravel.tecnologia.ws/WS/wsuPostData.php";

                    // var uri = new Uri(string.Format(url, produto.Id));

                    var data = JsonConvert.SerializeObject(usuarios);
                    url = String.Format("{0}?Nome_user={1}&Email_user={2}&Senha_user={3}", url, usuarios.Nome_user.ToString(), usuarios.Email_user.ToString(), usuarios.Senha_user.ToString());
                    //var content = new StringContent(data, "application/json");

                    HttpResponseMessage response = null;
                    if (data != null)
                    {
                        response = await client.PostAsync(url, new StringContent(data));
                        String responseJson = await response.Content.ReadAsStringAsync();
                    return responseJson;

                    }
                    


                    if (!response.IsSuccessStatusCode)
                    {
                        return "erro";
                        throw new Exception("Erro ao cadastar");

                    }
                    else
                    {
                        return "erro";
                    }
                    
                }
            }
            catch (HttpRequestException e)
            {
                System.Diagnostics.Debug.WriteLine(e);
                return "erro";
            }
        }
       
    }
}
