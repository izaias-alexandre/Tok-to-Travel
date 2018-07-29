using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.ComponentModel;
using System.Text;
using System.Windows.Input;

namespace ToktoTravel.ViewModel
{
    public class EventosViewModel : INotifyPropertyChanged
    {
     
        private ObservableCollection<Model.Eventos> eventos { get; set; }
        public ObservableCollection<Model.Eventos> Eventos
        {
            get { return eventos; }
            set
            {
                eventos = value;
                PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(nameof(Eventos)));
            }
        }
        public EventosViewModel()
        {
            CarregarEventos();
        }
        public async void CarregarEventos()
        {
            Eventos = new ObservableCollection<Model.Eventos>();
          
                var eventos = await Api.ApiEventos.GetAsync();
                Eventos = new ObservableCollection<Model.Eventos>(eventos);
           
        }

        public event PropertyChangedEventHandler PropertyChanged;
    }
}
