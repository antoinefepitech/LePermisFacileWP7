using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Data.Entity;

namespace MyToDo.Models
{
    public class TodoItem
    {
        [Key]
        public int ID { get; set; }
        public string Title { get; set; }
        public string Description { get; set; }
        public int state { get; set; }
        public DateTime DeadLine { get; set; }
        public string UserCreated { get; set; }
        public string UserWork { get; set; }
        public string UserWorkName { get; set; }
        public string UserCreatedName { get; set; }
        public int MasterTask { get; set; }

        public TodoItem(int ID, string Title)
        {
            this.ID = ID;
            this.Title = Title;
        }
        public TodoItem()
        {

        }

    }

    public class TodoItemDBContext : DbContext
    {
        public DbSet<TodoItem> Tasks { get; set; }
    }
}