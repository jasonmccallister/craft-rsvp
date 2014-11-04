Craft RSVP Plugin
==========

Craft plugin for simple RSVP on your site - great for wedding sites!

### Notifications

Simple email notifications are built into the plugins settings, I just have not implemented them as of yet.

**(pull requests are _highly_ encouraged and welcomed)**

### Example Form

```html
<form id="rsvp" action="" method="post">

    {{ getCsrfInput() }}
    <input type="hidden" name="action" value="rsvp/submit">
    <input type="hidden" name="redirect" value="/rsvp?success=true">

    <div>
    <label>Name (First and Last) *
        <input type="text" placeholder="First Last" id="name" name="name" />
    </label>
    </div>

    <div>
        <label>Email *
            <input type="text" placeholder="youremail@gmail.com" id="email" name="email" />
        </label>
    </div>

    <div>
        <label>Phone *
            <input type="text" placeholder="555-555-1234" id="phone" name="phone" />
        </label>
    </div>

    <div>
        <label>Attending? *
            <select name="attending" id="attending">
                <option value="Yes">Yes, Wouldn't miss it!</option>
                <option value="No">No, Unable to make it.</option>
            </select>
        </label>
    </div>

    <div>
        <label>Number of Guests (including yourself) *
            <input type="number" placeholder="2" name="guests" id="guests" />
        </label>
    </div>

    <div >
        <label>Comments - please provide the first and last name of any requested guests below:*
            <textarea placeholder="" rows="10" name="comments" id="comments"></textarea>
        </label>
        <input type="submit" value="RSVP" >
    </div>

</form>
```
