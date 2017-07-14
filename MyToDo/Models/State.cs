using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace MyToDo.Models
{
    public class State
    {
        public int id { get; set; }
        public string label { get; set; }

        public State(int id, string label)
        {
            this.id = id;
            this.label = label;
        }       
    }
}