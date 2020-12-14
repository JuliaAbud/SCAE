/*
In NativeScript, the app.ts file is the entry point to your Application.
You can use this file to perform app-level initialization, but the primary
purpose of the file is to pass control to the app’s first module.
*/

import { Application } from '@nativescript/core';




   
 
Application.run({ moduleName: 'app-root' });

/*
Do not place any code after the Application has been started as it will not
be executed on iOS.
*/
