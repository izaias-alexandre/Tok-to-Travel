using System.Collections.ObjectModel;
using ToktoTravel.Model;
using ToktoTravel.ViewModel;
using Newtonsoft.Json;
using System.Threading.Tasks;
using System.Collections.Generic;
using System.Net;
using System.Net.Http;

namespace ToktoTravel.Service
{
    public class LocaisService
    {
        /* private ObservableCollection<Locais> categorias = new ObservableCollection<Locais>();
         public CategoriaService()
         { }

         public ObservableCollection<Locais> GetCategorias()
         {


             categorias.Add(new Locais() { Cod_local = 1, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 2, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 3, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 4, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 5, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 6, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 7, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 8, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 9, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 10, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 11, Nome_loc = "" });
             categorias.Add(new Locais() { Cod_local = 12, Nome_loc = "" });


             return categorias;
         }

         public void Add(Locais categoria)
         {
             categorias.Add(categoria);
         }
     }*/
        //private HttpClient_Client = new HttpClient();

       // public HttpClient _client = new HttpClient();

        public List<Local> _locais;

        public async Task<List<Local>> Localiza()
       // {
            /*if (string.IsNullOrWhiteSpace(local))
            {
                return null;
            }*/
            //else
            {
                using (var client = new HttpClient())
                {
                    var json = await client.GetStringAsync("http://izaiasalexandre13.000webhostapp.com/MVCv5/WS/consultaWSL.php");
                    var livros = JsonConvert.DeserializeObject<List<Local>>(json);
                    _locais = new List<Local>(livros);
                    // Console.Write(json);
                   
                }


         
                return _locais;
            }
        }
    }

