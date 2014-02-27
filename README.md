# HOW TO USE

    {exp:redirect_to_member}

### options

- base_url (optional) = initial url segment
- extra (optional) = segment after username
- login_path (optional) = redirect if no logged in user detected




## EXAMPLE
---

    {if segment_2 == ""}
        {exp:redirect_to_member base_url="member" extra="success" login_path="/log_me_in"}
    {/if}

redirects to "/member/{username}/success" if logged in

redirects to "/log_me_in" if not logged in