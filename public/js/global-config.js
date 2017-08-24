var global_conf = {

    /**
     * The subdir config item allows you to set the subdirectory that the project
     * is running out of in a single place. This will be imported by all the js
     * in the site, so that you only have to set it here. If the project is
     * running in the root directory, simply leave this empty.
     *
     * Please do not include a / at the end of this string.
     */

    subdir: "" //local url
    //subdir: "/e-content" //dev url


};

console.log("Subdir is set to: " + global_conf["subdir"]);
