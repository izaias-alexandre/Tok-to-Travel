using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Text;
using System.Windows.Input;

namespace ToktoTravel.ViewModel
{
    public class LocaisViewModel : INotifyPropertyChanged
    {

        private ObservableCollection<Model.Locais> locais { get; set; }
        public ObservableCollection<Model.Locais> Locais
        {
            get { return locais; }
            set
            {
                locais = value;
                PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(Locais)));
            }
        }

        public event PropertyChangedEventHandler PropertyChanged;
        public LocaisViewModel()
        {
            CarregarLocais();
        }
        public  async void CarregarLocais()
        {
            Locais = new ObservableCollection<Model.Locais>();
            
              var local = await Api.ApiLocais.GetAsync();
            Locais = new ObservableCollection<Model.Locais>(local);

            
        }
       
        
               
        
                
             

    }
        
}

