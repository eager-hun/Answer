
# Place for custom data handlers.

## Significance

The distinction between standard and custom data handlers will matter when
migrating site contents between application instances (upon "app updates").

The data handlers in the  'standard' dir should be considered that part of the
app that gets updated, so they are not subject to migrating, the new app
instance should contain their possibly updated versions.

The data handlers in the 'custom' dir however are subject to migrating into
the new app instance.

## Considerations

As per the current app implementation, when calling a data handler by its name
(a.k.a. id), the app first will look for it in the 'standard' dir, and if it
doesn't find it there, then it will look for it in the 'custom' dir.

This implies that you cannot have a custom data handler with a name
that's identical to one among the standard ones, because in that case, first
the standard one will be invoked, then invoking that id will not be attempted
any more.
