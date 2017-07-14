using System.Collections.Generic;
using System.Data.Entity;
using System.Web.Mvc;

namespace MyToDo.Models
{
    public class AspNetUsers
    {
        public string id { get; set; }
        public string UserName { get; set; }
    }

    public class UserDBContext : DbContext
    {
        public DbSet<AspNetUsers> Members { get; set; }
    }
}