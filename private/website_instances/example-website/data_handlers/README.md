# Place for custom data handlers.

As per the current app implementation, when calling a data handler by its name
(a.k.a. id), the app first will look for it in /private/data_handlers/, and if
it doesn't find it there, then it will look for it here, in
/private/website_instances/*/data_handlers/ .

This implies that one cannot have a custom data handler with a name
that's identical to one among the standard ones, because in that case, first
the standard one will be invoked, then invoking that id will not be attempted
