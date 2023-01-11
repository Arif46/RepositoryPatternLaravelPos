import actions from './actions'
import getters from './getters'
import Custom from './custom'
import { mutations } from './mutations'

const state = {
  commonObj: {
    hasDropdownLoaded: false,
    componentList: [],
    divisionList: [],
    districtList: [],
    upazilaList: [],
    moduleList: [],
    serviceList: [],
    unionList: [],
    cityCorporationList: [],
    municipalityList: [],
    orgProfileList: [],
    fiscalYearList: [],
    wardList: [],
    dialogueInfosList: [],
    designationList: [],
    bankList: [],
    officeTypeList: [],
    officeList: [],
    menuList: [],
    notificationTemplateList: [],
    templateList: [],
    notificationTypeList: [],
    documentCategoryList: [],
    ministryNameList: [],
    portalServiceTypeList: Custom.portalServiceTypeList,
    orgComponentList: [],
    portalServiceCategoryList: [],
    portalCustomerTypeList: [],
    exOrgList: [],
    externalPanelList: [],
    externalMenuList: [],
    componentOrgList: [],
    componentDesignationList: [],
    countryList: []
  }
}

export default {
  namespaced: true,
  state,
  actions,
  getters,
  mutations
}
