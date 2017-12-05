<template lang="html">
  <div class="container">
    <div class="section">
      <div class="columns is-centered">
        <div class="column is-8">
          <div class="columns">
            <div class="column">
              <h3 class="title is-4"> Personal Profile </h3>
              <article class="media">
                <figure class="media-left" style="width: 140px; border: 1px solid lightgrey;">
                  <p class="image">
                    <img src="../../images/user.png" style="border-radius: 50%" alt="Placeholder image">
                  </p>
                  <h4 class="title is-6" style="padding: 10px;">
                    <span> Change Photo </span>
                    <span>
                      <i class="fa fa-pencil"></i>
                    </span>
                  </h4>
                </figure>

                <div class="media-content">
                  <div class="content">
                     <p><strong class="title is-2"> John Smith </strong></p>
                     <p><small>@johnsmith</small> <small>31m</small></p>
                  </div>
                </div>
              </article>
            </div>
          </div>
          <div class="columns">
            <div class="column">
              <div class="content">
                <!-- <label for=""><strong>Address :</strong></label>
                <label for="">204, Silicon Tower, Ahmedabad</label>
                <span>
                  <i class="fa fa-pencil"></i>
                </span> -->
                <table>
                    <tbody>
                      <tr>
                        <th> Name </th>
                        <td> <span> John Smith </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span></td>
                      </tr>
                      <tr>
                        <th> Address </th>
                        <td> <span>204, Silicon Tower, Ahmedabad </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span></td>
                      </tr>
                      <tr>
                        <th> Email </th>
                        <td><span> abc@example.com </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span></td>
                      </tr>
                      <tr>
                        <th> Date Of Birth </th>
                        <td><span> 19/10/1981 </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span></td>
                      </tr>
                      <tr>
                        <th> Phone </th>
                        <td><span> +91-1234567890 </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span></td>
                      </tr>
                      <tr>
                        <th> Gender </th>
                        <td><span> Male </span><span class="cursor-pointer"><i class="fa fa-pencil"></i></span></td>
                      </tr>
                    </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- <h3 class="title is-4"> Personal Profile </h3>
      <article class="media">
        <figure class="media-left" style="width: 140px; border: 1px solid lightgrey;">
          <p class="image">
            <img src="../../images/user.png" style="border-radius: 50%" alt="Placeholder image">
          </p>
          <h4 class="title is-6" style="padding: 10px;">
            <span> Change Photo </span>
            <span>
              <i class="fa fa-pencil"></i>
            </span>
          </h4>
        </figure>

        <div class="media-content">
          <div class="content">
             <p><strong class="title is-2"> John Smith </strong></p>
             <p><small>@johnsmith</small> <small>31m</small></p>
          </div>
        </div>
      </article> -->


      </div>
    </div>


  </div>
</template>

<script>
export default {
}
</script>

<style lang="css">
  .mainpage{
    border: 2px solid red;
  }
  .cursor-pointer{
    cursor: pointer
  }
  .content table th, .content table td{
    border: none;
  }
</style>
