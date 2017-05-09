using Microsoft.Owin;
using Owin;

[assembly: OwinStartupAttribute(typeof(sowa.Startup))]
namespace sowa
{
    public partial class Startup {
        public void Configuration(IAppBuilder app) {
            ConfigureAuth(app);
        }
    }
}
