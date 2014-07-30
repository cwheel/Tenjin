# Tenjin

A day by day start screen. Tenjin is designed to be displayed on an always-on moniter. The default modules will provide weather, OneNote homework integration, Reddit News, alarm clocks, and clothing recommendations (based on weather). Tenjin is built for two roommates and the config file is setup as such.

#### OneNote Integration

Currently, Micosoft provides no web based methods for accessing a users notebook pages. However, they do provide a C# interface for reading the pages in XML. Tenjin Sync is a quickly cobbled together attempt to bridge between the web and the C# interface. Currently, the homework module only supports reading from the raw XML of the notebook page. Tenjin Sync publishes such XML to your webserver (likely IIS if your running Windows Server). Your not required to use Tenjin Sync to provide the XML, your only required to have such XML accessable in one way or another.

