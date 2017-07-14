using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web.Mvc;
using MyToDo.Models;
using System.Collections.Generic;
using Microsoft.AspNet.Identity;
using System.Collections;

namespace MyToDo.Controllers
{
    public class TodoController : Controller
    {
        private TodoItemDBContext db = new TodoItemDBContext();
        private UserDBContext dbUser = new UserDBContext();
        private List<State> states = new List<State>();
        private List<TodoItem> tasks = new List<TodoItem>();
        // GET: Todo

        public TodoController() : base()
        {
            states.Add(new State(0, "Do"));
            states.Add(new State(1, "Doing"));
            states.Add(new State(2, "Done"));
        
        }
        public ActionResult Index()
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            ViewBag.States = states;
            tasks = db.Tasks.ToList();
            ViewBag.Tasks = getListTasks(tasks);
            return View();
        }

        public ActionResult MyTasks()
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            ViewBag.States = states;
            string userId = User.Identity.GetUserId();
            tasks = db.Tasks.Where(task => task.UserWork == userId).ToList();
            ViewBag.Tasks = getListTasks(tasks);
            return View();
        }

        public ActionResult MyCreatedTasks()
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            ViewBag.States = states;
            string userId = User.Identity.GetUserId();
            var req = db.Tasks.Where(task => task.UserCreated == userId);
            ViewBag.Tasks = getListTasks(req.ToList());
            return View();
        }

        // GET: Todo/Details/5
        public ActionResult Details(int? id)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            TodoItem todoItem = db.Tasks.Find(id);
            if (todoItem == null)
            {
                return HttpNotFound();
            }
            ViewBag.States = states;
            return View(todoItem);
        }

        // GET: Todo/Create
        public ActionResult Create()
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            ViewBag.Memebers = getSelectUsersList(dbUser.Members.ToList());
            ViewBag.States =   getSelectStateList();
            ViewBag.Tasks =    getSelectTasksList(tasks);
            return View();
        }


        // POST: Todo/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Title, Description , state, DeadLine, UserWork, MasterTask")] TodoItem todoItem)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            if (ModelState.IsValid)
            {
                todoItem.UserCreated = User.Identity.GetUserId();
                todoItem.UserCreatedName = User.Identity.GetUserName ();
                todoItem.UserWorkName = dbUser.Members.Find(todoItem.UserWork).UserName;
                db.Tasks.Add(todoItem);
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.Memebers = getSelectUsersList(dbUser.Members.ToList());
            ViewBag.States = getSelectStateList();
            ViewBag.Tasks = getSelectTasksList(tasks);
            return View();
        }

        // GET: Todo/Edit/5
        public ActionResult Edit(int? id)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            TodoItem todoItem = db.Tasks.Find(id);
            if (todoItem == null)
            {
                return HttpNotFound();
            }
            tasks = db.Tasks.ToList();
            ViewBag.Members = getSelectUsersList(dbUser.Members.ToList(), todoItem.UserWork);
            ViewBag.DeadLine = todoItem.DeadLine.ToString("yyyy-MM-dd");
            ViewBag.States = getSelectStateList(todoItem.state);
            ViewBag.Tasks = getSelectTasksList(tasks);
            return View(todoItem);
        }

        // POST: Todo/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
    
        public ActionResult Edit([Bind(Include = "ID,Title,Description,state,DeadLine,UserCreated,UserWork,UserWorkName,UserCreatedName,MasterTask")] TodoItem todoItem)
        {
            if (ModelState.IsValid)
            {
                todoItem.UserCreated = User.Identity.GetUserId();
                todoItem.UserCreatedName = User.Identity.GetUserName();
                todoItem.UserWorkName = dbUser.Members.Find(todoItem.UserWork).UserName;
                db.Entry(todoItem).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(todoItem);
        }


        // GET: Todo/Delete/5
        public ActionResult Delete(int? id)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            TodoItem todoItem = db.Tasks.Find(id);
            if (todoItem == null)
            {
                return HttpNotFound();
            }
            ViewBag.States = states;
            return View(todoItem);
        }

        // POST: Todo/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            TodoItem todoItem = db.Tasks.Find(id);
            db.Tasks.Remove(todoItem);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        private IEnumerable<SelectListItem> getSelectUsersList(IEnumerable<AspNetUsers> users, string idSelect = null)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            AspNetUsers userSelected = null;
            int i = -1;
            if (idSelect != null)
            {
                while (++i < users.Count() && userSelected == null)
                {
                    if (users.ElementAt(i).id == idSelect)
                        userSelected = users.ElementAt(i);
                }
            }
            return new SelectList(users, "id", "UserName", userSelected);
        }

        private IEnumerable<SelectListItem> getSelectStateList(int currentState = -1)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            State stateSeleted = null;
            int i = -1;
            if (currentState != -1)
            {
                while (++i < states.Count() && stateSeleted == null)
                {
                    if (states.ElementAt(i).id == currentState)
                        stateSeleted = states.ElementAt(i);
                }
            }
            return new SelectList(states, "id", "label", stateSeleted);

        }

        private IEnumerable<SelectListItem> getSelectTasksList(IEnumerable<TodoItem> tasks, int idSelect = -1)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            TodoItem taskSelect = null;
            List<TodoItem> items = new List<TodoItem>();
            int i = -1;
            items.Add(new TodoItem(-1, "None"));
            foreach (var item in tasks)            
                items.Add(item);
            if (idSelect != -1)
            {
                while (++i < tasks.Count() && taskSelect == null)
                {
                    if (tasks.ElementAt(i).ID == idSelect)
                        taskSelect = tasks.ElementAt(i);
                }
            }
            return new SelectList(items, "ID", "Title", taskSelect);
        }

        private Hashtable getListTasks(List<TodoItem> items)
        {
            if (!Request.IsAuthenticated)
                Response.Redirect("/Account/Login");
            Hashtable myHashTable = new Hashtable();
            List<TodoItem> tmp_list;
            TodoItem tmp_task;
            foreach (var item in items)
            {
                if (item.MasterTask == 0|| item.MasterTask == -1)
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
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
