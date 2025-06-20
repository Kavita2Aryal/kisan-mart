@extends('layouts.app')
@section('title', 'Help')

@section('content')
<div class="container-fluid">
	<div class="row m-t-30 m-b-20">
        <div class="col-12 col-lg-6 ml-lg-auto mr-lg-auto">
            <div class="card card-default">
                <div class="card-header p-t-30 p-b-10 p-r-30 p-l-30">
                    <div class="card-title full-width">
                        User Manual
                        <div class="pull-right text-right">
                            <img src="{{ asset('assets/img/tccms-logo.svg') }}" alt="logo" style="width: 47%;">
                        </div><br/>
                        {{ config('app.config.system.version') }}
                    </div>
                </div>
                <div class="card-body p-b-30 p-r-30 p-l-30">
                    <div class="m-t-25">
                        <h5>How to create new User Roles and assign different permissions?</h5>
                        <div>
                            <p>The user role here refers to the sort of role that a user holds, such as admin, superadmin, or operators. Each user can set their own permissions, which determines which parts of the backend they have access to.</p>
                            <p>To gain access to this portion of the backend, we'll first go to the menu and select User Role Manager. To create a user role and give permissions, go to the top right corner of the page and click the add user role button. We can enter the role name in the access role input area, and the active check box determines whether or not this role is active on the backend. The permit all modules check box when clicked will give all the backend permission to this role alternatively we can manually choose each permission. The permissions mainly contain add edit view and change status from active to inactive of the backend features. The general permission list contains the control over updating major parts of the backend like settings update, cache clear, etc.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to edit existing User Roles and change the permissions?</h5>
                        <div>
                            <p>To edit the existing role go back to the User Role Manager and here we can see list of existing user roles and their assigned permission on the top right of each role there is an edit button clicking on this button will lead to the edit page of that role from here we can edit the role name and add or remove the permission for that role.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create a new User and customize the permissions?</h5>
                        <div>
                            <p>Go to User Manager from the menu to create a new user who can log in to the backend and make changes. We can see a list of the system's current users here in the table. To add a new user, go to the top right corner of the screen and click the Add user button. This will take us to the create user form, where we can fill in the user's name, email address, and access role. Choosing an access role will automatically fill in the permissions associated with it; however, we can remove or add permissions manually, and a new user can be created by clicking the create user option on the top right.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to edit existing Users and customize the permissions?</h5>
                        <div>
                            <p>To edit the existing users go back to the User Manager and choose any user to edit from the table. The deactivate button will disable and enable the user’s ability to login in to the backend. Clicking on the edit button will lead to the edit page of that user on this page we can change the information, add remove permissions, change roles, etc.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to use Web Settings?</h5>
                        <div>
                            <p>The Web Settings contains the Generic SEO settings, contact settings, and general settings.</p>
                            <p>Generic SEO settings: This is where we can update the website’s SEO meta titles and other SEO-related information along with the selection of SEO meta images. The toggle on the bottom when switched on the website will use generic SEO all over the website pages.</p>
                            <p>Contact Settings: The contact setting contains the contact information of the organization. It contains information like the website title, phone no. etc. The information can be changed here and by clicking the update setting it will be changed and reflected on the website.</p>
                            <p>General Settings: These are the basic settings of a website, such as a website title and the admin email address that will be used to receive and send messages to and from users via the contact form, feedback form, and so on. The active maintenance toggle switch is also located here, and when it is turned on, the frontend website will display a message indicating that it is under maintenance. This can be turned on while making big changes to the website to prevent users from seeing errors when they try to access it. The cache clear button will clear both the backend and frontend website's cache data.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5> How to create a new Page Layout?</h5>
                        <div>
                            <p>Go to the Page manager from the menu.Here you can see the list of existing pages in the system.To create a new page layout click add page.Here on the left side there are the section of the website and on the left you can drag and drop these section to create a complete single page. Headers and footers can’t be changed. When satisfied with the selected content from left to right click on the create page layout button on the top corner.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to add content to a new Page?</h5>
                        <div>
                            <p>After clicking on the create page layout button the page will lead to a list of forms to input the page details like titles and seo etc. Here on the left side there are the list of section we selected from the previous page.Click on these list and a form will be dynamically generate on the right where we can add content according to the selected content on the left.After the filling up all the content we can click create page to save and create a  new page.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to edit existing Page content?</h5>
                        <div>
                            <p>In the Page Manager click on the page you want to edit by clicking on the edit button.The process here is same as while creating a page.Select the section on the left side of which the content is to be edited and click update page.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to mark a page as a Home Page?</h5>
                        <div>
                            <p>In the Page Manager, there is a button titled mark as home click on this button to make the required page the homepage of the website.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to upload multiple images in a Media Gallery?</h5>
                        <div>
                            <p>Go to the Media Gallery from the menu. Here we can see a list of the uploaded media on the backend. To upload an image we will click on the upload button which will open the uploader page here we can upload multiple images at once. We can drag and drop the images and they will be uploaded to the backend.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to add an image title, and caption for each image in the Media Gallery?</h5>
                        <div>
                            <p>In the Media Gallery below each of the listed images click on the pencil icon and a form will pop up here the image title, author, and captions can be added and updated for each image.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Menu content?</h5>
                        <div>
                            <p>Go to Menu Manager from the menu. Here, we can either add a new menu item by clicking on the “Add/Edit/Custom Menu” tab, fill the form then click “Add Menu” or by clicking on the “Standalone Page” bar which will display the pages we created using page manager, select the required pages and click “Add Selected”. There is also the default page tab from where we can add default pages to the menu. The display order of the added menu item can be managed. After the menu is built click “Save Menu”.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Mobile Menu content?</h5>
                        <div>
                            <p>Go to Menu Manager from the menu. Here, we can either select the mobile menu the same as the desktop menu or create a separate menu for mobile. To create a separate mobile menu, click on the Mobile Menu button then we can continue the same process to create and edit the mobile menu as we did for the desktop menu.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Slider content?</h5>
                        <div>
                            <p>Go to Slider Manager from the menu. Here we can view the list of existing sliders. Click on the add slider button. Click “Add Video Slide” OR “Add Image Slide” at the right top to add video or images as per requirements. You can add multiple forms. Fill the required form and then, Click “Create Slider”.The popup form will be generated. Fill the form and “Save”.The same process can be repeated by clicking the edit button beside the existing sliders.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to change the display order of Slider content?</h5>
                        <div>
                            <p>In the Slider Manager click on the sort button of the slider we want to sort the content for here we can find the list of slider contents which can be sorted by dragging the content and dropping on the required way.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Quick Link content?</h5>
                        <div>
                            <p>Go to the Quick Link Manager from the menu.Here we can view the list of existing quick links in the backend.Click on the add quick link button on the top right or click on the edit button of the quick link to be edited.From here in the form we can add or edit the quick link contents like from selection the quick link group the link will appear in and its title and url.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to change the display order of Quick Link content?</h5>
                        <div>
                            <p>To change the display order of the Quick Link contents click on the sort quick link button on the top right corner and choose the group of which quick links contents has to be sorted.After that we can drag and drop the quick link contents in the required order.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Social Media content?</h5>
                        <div>
                            <p>Go to the Social Media manager from the menu. Here we can view the list of existing social media in the backend. Click the “Add Social Media” button where we can add details by submitting the form. We can edit, delete and unpublish social media as needed. Click the “Sort Social Media” button to sort the media as per requirement.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Notice/Popup content?</h5>
                        <div>
                            <p>Go to Notice/Popup manager from the menu.Here we can view the list of existing Notice/Popup in the backend.Click the “Add notice” button where we can add details like title link descriptions and also images which can be uploaded by drag and drop by submitting the form. We can edit, delete and unpublish notices as needed.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit News content?</h5>
                        <div>
                            <p>Go to the News  Manager from the menu.Here we can view the list of existing News in the backend.The trashed News button will lead to the previously deleted News  from here these datas can be deleted permanently from the database. Click the Add News button or the edit button for News we want to edit and we can add/edit details like name, title subtitle etc. It also contains the place to add/edit seo for that particular News .We can add blocks of description/image/image gallery./video  by clicking on the icons next to the add block text according to the requirement.</p>
                        </div>
                    </div>
                    <div class="m-t-25">
                        <h5>How to create and edit Partner content?</h5>
                        <div>
                            <p>Go to the Partner Manager from the menu. Click “Add Partner” button where we can add details by submitting the form. We can edit, delete and unpublished partners as needed. Click “Sort Partner” button to sort the data as per requirement.</p>
                        </div>
                    </div>
                    <div class="m-t-50">
                        <p>If you did not find what you were looking for,</p>
                        <p>Send us your queries at <a href="mailto:{{ config('app.config.system.email') }}" class="text-complete">{{ config('app.config.system.email') }}</a></p>
                        <div>
                            <a href="{{ config('app.config.system.website') }}" class="text-info" target="_blank">
                                <img src="{{ asset('assets/img/tc-logo.png') }}" alt="logo" width="25" class="m-r-5">
                                <span style="font-size: 16px;">{{ config('app.config.system.name') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection