using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Web.Mvc;
using MyToDo.Models;
using Microsoft.AspNet.Identity;
using System.Collections;

namespace MyToDo.Controllers
{
    public class HomeController : Controller
    {
        private TodoItemDBContext dbTodo = new TodoItemDBContext();
        private UserDBContext dbUser = new UserDBContext();
        private List<State> states = new List<State>();
        private List<TodoItem> tasks = new List<TodoItem>();

        public HomeController() : base()
        {
            states.Add(new State(0, "Do"));
            states.Add(new State(1, "Doing"));
            states.Add(new State(2, "Done"));
            tasks = dbTodo.Tasks.ToList();
        }

        // GET: Home
        public ActionResult Index()
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            ViewBag.States = states;
            string userId = User.Identity.GetUserId();
            var workedTask = dbTodo.Tasks.Where(t => t.UserWork == userId).ToList();

            if (workedTask != null)
            {
                ViewBag.Tasks = getListTasks(workedTask);
            }
            return View(dbTodo.Tasks.ToList());
        }


        private Hashtable getListTasks(List<TodoItem> items)
        {
            Hashtable myHashTable = new Hashtable();
            List<TodoItem> tmp_list;
            TodoItem tmp_task;
            foreach (var item in items)
            {
                if (item.MasterTask == 0 || item.MasterTask == -1)
                {
                    tmp_list = new List<TodoItem>();
                    tmp_list.Add(item);
                    myHashTable.Add(item.ID.ToString(), tmp_list);
                }
                else
                {
                    tmp_task = new TodoItem();
                    tmp_task = tasks.Find(t => t.ID == item.MasterTask);
                    if (!myHashTable.ContainsKey(item.MasterTask))
                    {
                        tmp_list = new List<TodoItem>();
                        if (tmp_task != null)
                        {
                            tmp_list.Add(tmp_task);
                            myHashTable.Add(item.MasterTask, tmp_list);
                        }
                        else
                        {
                            tmp_list.Add(item);
                            myHashTable.Add(item.ID, tmp_list);
                        }
                    }
                    if (tmp_task != null)
                        ((List<TodoItem>)myHashTable[item.MasterTask]).Add(item);
                }
            }
            return (myHashTable);
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                dbTodo.Dispose();
            }
            base.Dispose(disposing);
        }

    }
}
