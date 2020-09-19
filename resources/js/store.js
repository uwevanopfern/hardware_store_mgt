import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        api: {
            /*Parameters to use on offline local server*/
            locServerUrl: "http://127.0.0.1:9000/",

            /*Parameters to use on online server*/
            prodServerUrl: "",

            /*Parameters to use on online production server*/
            serverUrl: "",
            token: "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiMzI3MTQ3ZmM1NGE3NWExNTcxYTk1OWMwM2Q3YzZiNjk1Y2JiZDQ0Y2Q0NzMyYTM0YWE0NzI3ZmMxNTk1NTBhMGRlYTI0OTIxY2QxOTUxNDYiLCJpYXQiOjE2MDA1MzA3MjksIm5iZiI6MTYwMDUzMDcyOSwiZXhwIjoxNjMyMDY2NzI5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.4yocIGP-zAypLbEnV4_0LamGo5t8ZOCMvmxc9cdVmKsAazVqvllUZhoZ_kFZIJ_HlaSAD5A5pqS6UO2oWvyES1D_k7CBBiSmJANrMBrtuQQI6JdEX70foftf4YkCXW4qB3pNFXPZMzCyBHB_Vme31WguYG_H_DfCxuLbpSYagN_F3xrsqr4Eb9kMB3veglM6iGqt2MK52YbNZ1X4NvwqTBBC5lYhZ8vkAyBWd13eeXmv7yfoRmCSr5qUe45LQ1tsEebWXQHtEwi8gnm_89Wzr2nXDGuZqlG2N4y1FI6U0h7nxYIXli4P3kU_zL2Wcq1ebZp47O3n81C3iBf9Ds7hf6UgoH0AQ36NoUCEMh8R1kzwXiywMqkvYAYg_Khtn2elD_GHzqllxmSqvx258vmvNqC43R6LDsKM4MyzCeC8jUaWveHTQ72oiZWnOnIra3UWW7o43mgwJ2zmVsT3zhpxD_GndnADoMwrrPGUC05tvuFClk6ieUkmmDnDE4--9xc3kabUqLcVuCKXgDmNQTi-23fCOGaaM_qSsNtpPSnXmVc5ifpnwP2Wt2CFlC6LBNkd18b91OpcsqMxh_zaMJyvNdPYyjfhv64sSpo9PFTVKWNlG5A_KWpya2Pw5PzMJq9QYp4WM360nUkvAt8sQVfWp5UcHQpthssqSwPJGpIGEq8",
            path: {
                login: "api/login", // Admin login
                register: "api/users" // Admin register
            }
        }
    },
    mutations: {},
    actions: {},
    getters: {}
});
