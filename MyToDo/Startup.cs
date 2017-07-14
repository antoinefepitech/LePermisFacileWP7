using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(MyToDo.Startup))]
namespace MyToDo
{
    public partial class Startup
    {
        public void Configuration(IAppBuilder app)
        {
            ConfigureAuth(app);
        }
    }
}
